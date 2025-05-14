<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentRequestResource\Pages;
use App\Filament\Resources\DocumentRequestResource\RelationManagers;
use App\Models\DocumentRequest;
use App\Models\DocumentType;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DocumentRequestResource extends Resource
{
    protected static ?string $model = DocumentRequest::class;
    protected static ?string $navigationGroup = 'Documents';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('resident_id')
                    ->label('Resident')
                    ->relationship('resident', 'id')
                    ->getOptionLabelFromRecordUsing(fn($record) => $record->full_name)
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('document_type_id')
                    ->label('Document Type')
                    ->options(
                        DocumentType::pluck('name', 'id')
                    )
                    ->required(),

                Textarea::make('purpose')->label('Purpose')->rows(3),

                Select::make('status')
                    ->options([
                        'Pending' => 'Pending',
                        'Approved' => 'Approved',
                        'Rejected' => 'Rejected',
                        'Printed' => 'Printed',
                    ])
                    ->default('Pending'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('resident.full_name')
                    ->label('Resident Name')
                    ->sortable()
                    ->searchable(query: function (Builder $query, string $search) {
                        $query->whereHas('resident', function ($q) use ($search) {
                            $q->where('first_name', 'like', "%{$search}%")
                                ->orWhere('middle_name', 'like', "%{$search}%")
                                ->orWhere('last_name', 'like', "%{$search}%");
                        });
                    }),

                SelectColumn::make('status')
                    ->label('Change Status')
                    ->options([
                        'Pending' => 'Pending',
                        'Approved' => 'Approved',
                        'Rejected' => 'Rejected',
                        'Printed' => 'Printed',
                    ])
                    ->sortable(),

                // TextColumn::make('status')
                //     ->label('Status')
                //     ->badge()
                //     ->color(fn(string $state): string => match ($state) {
                //         'Pending' => 'warning',
                //         'Approved' => 'success',
                //         'Rejected' => 'danger',
                //         'Printed' => 'info',
                //         default => 'gray',
                //     }),

                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime('M d, Y h:i A')
                    ->sortable()
                    ->tooltip(fn($record) => "Last updated: " . $record->updated_at->format('M d, Y h:i A')),

                TextColumn::make('documentType.name')
                    ->label('Document Type')
                    ->sortable(),


                // TextColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Print')
                    ->label('Print')
                    ->url(fn($record) => route('documents.print', $record))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-printer')
                    ->visible(fn($record) => $record->status === 'Approved'),
                // ->visible(fn ($record) => $record->status === 'approved' && auth()->user()->isAdmin())

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocumentRequests::route('/'),
            'create' => Pages\CreateDocumentRequest::route('/create'),
            'edit' => Pages\EditDocumentRequest::route('/{record}/edit'),
        ];
    }
}
