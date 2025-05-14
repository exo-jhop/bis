<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurokResource\Pages;
use App\Filament\Resources\PurokResource\RelationManagers;
use App\Models\Purok;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PurokResource extends Resource
{
    protected static ?string $model = Purok::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationParentItem = 'Cities';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Purok Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->label('Purok Name')
                            ->placeholder('Enter purok name'),
                        Forms\Components\Select::make('barangay_id')
                            ->relationship('barangay', 'name')
                            ->required()
                            ->label('Barangay')
                            ->searchable()
                            ->preload(),
                    ])
                    ->columns(2)
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Purok Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('barangay.name')
                    ->label('Barangay Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('residents_count')
                    ->label('Resident Count')
                    ->counts('residents'),
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
            'index' => Pages\ListPuroks::route('/'),
            'create' => Pages\CreatePurok::route('/create'),
            'edit' => Pages\EditPurok::route('/{record}/edit'),
        ];
    }
}
