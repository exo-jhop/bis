<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrgyIDResource\Pages;
use App\Filament\Resources\BrgyIDResource\RelationManagers;
use App\Models\BrgyID;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;

class BrgyIDResource extends Resource
{
    protected static ?string $model = BrgyID::class;
    protected static ?string $label = 'Barangay ID';
    protected static ?string $navigationIcon = 'heroicon-o-identification';
    protected static ?string $navigationGroup = 'Documents';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Brgy ID')
                    ->schema([
                        Select::make('resident_id')
                            ->relationship('resident', 'id')
                            ->getOptionLabelFromRecordUsing(fn($record) => $record->full_name)
                            ->required()
                            ->label('Resident Name')
                            ->searchable()
                            ->preload()
                            ->reactive(),
                        TextInput::make('id_number')
                            ->required()
                            ->label('ID Number')
                            ->maxLength(255)
                            ->suffixAction(
                                Action::make('generateId')
                                    ->icon('heroicon-o-sparkles')
                                    ->tooltip('Generate Random ID')
                                    ->action(function ($set) {
                                        $randomId = strtoupper(Str::random(8));
                                        $set('id_number', $randomId);
                                    })
                            ),
                        DatePicker::make('issue_date')
                            ->required()
                            ->label('Issued At')
                            ->default(now()),
                        Textarea::make('remarks')
                            ->label('Remarks')
                            ->maxLength(255),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_number')
                    ->searchable(),

                TextColumn::make('resident.full_name')
                    ->label('Resident Name')
                    ->getStateUsing(fn($record) => $record->resident->full_name)
                    ->searchable([
                        'residents.first_name',
                        'residents.middle_name',
                        'residents.last_name',
                    ])
                    ->sortable(),



                TextColumn::make('id_number')
                    ->label('ID Number')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListBrgyIDS::route('/'),
            'create' => Pages\CreateBrgyID::route('/create'),
            'edit' => Pages\EditBrgyID::route('/{record}/edit'),
        ];
    }
}
