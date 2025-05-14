<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComplaintsResource\Pages;
use App\Filament\Resources\ComplaintsResource\RelationManagers;
use App\Models\Complaints;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComplaintsResource extends Resource
{
    protected static ?string $model = Complaints::class;
    protected static ?string $navigationIcon = 'heroicon-o-exclamation-triangle';
    protected static ?string $navigationGroup = 'Documents';
    protected static ?string $navigationLabel = 'Complaints and Requests';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Complaint/Request Information')
                    ->collapsible()
                    ->schema([

                        DatePicker::make('created_at')
                            ->label('Date')
                            ->prefixIcon('heroicon-o-calendar')
                            ->default(now())
                            ->required(),

                        Select::make('resident_id')
                            ->label('Resident Name')
                            ->relationship('resident', 'id')
                            ->getOptionLabelFromRecordUsing(fn($record) => $record->full_name)
                            ->searchable()
                            ->preload()
                            ->prefixIcon('heroicon-o-user')
                            ->required(),

                        Select::make('type')
                            ->label('Type')
                            ->options([
                                'complaint' => 'Complaint',
                                'request' => 'Request',
                            ])
                            ->prefixIcon('heroicon-o-document-text')
                            ->required(),

                        Textarea::make('description')
                            ->label('Description')
                            ->placeholder('Describe your complaint/request')
                            ->required(),

                        Select::make('priority')
                            ->label('Priority')
                            ->options([
                                'low' => 'Low',
                                'medium' => 'Medium',
                                'high' => 'High',
                            ])
                            ->prefixIcon('heroicon-o-flag')
                            ->required(),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pending',
                                'in_progress' => 'In Progress',
                                'resolved' => 'Resolved',
                            ])
                            ->default('pending')
                            ->prefixIcon('heroicon-o-check-circle')
                            ->required(),



                    ])
                    ->columns(2)
                    ->columnSpan(2),


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

                TextColumn::make('type')
                    ->label('Type')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('description')
                    ->label('Description')
                    ->limit(50)
                    ->sortable()
                    ->searchable(),

                TextColumn::make('priority')
                    ->label('Priority')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'in_progress' => 'info',
                        'resolved' => 'success',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'pending' => '⏳ Pending',
                        'in_progress' => '🚧 In Progress',
                        'resolved' => '✅ Resolved',
                    })

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListComplaints::route('/'),
            'create' => Pages\CreateComplaints::route('/create'),
            'edit' => Pages\EditComplaints::route('/{record}/edit'),
        ];
    }
}
