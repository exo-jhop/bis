<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangayOfficialPositionResource\Pages;
use App\Filament\Resources\BarangayOfficialPositionResource\RelationManagers;
use App\Models\BarangayOfficialPosition;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BarangayOfficialPositionResource extends Resource
{
    protected static ?string $model = BarangayOfficialPosition::class;

    protected static ?string $navigation = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationParentItem = 'Barangay Officials';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Barangay Official Position Information')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->label('Position Name')
                            ->prefixIcon('heroicon-o-briefcase')
                            ->placeholder('Enter position name'),
                        Textarea::make('description')
                            ->label('Description')
                            ->placeholder('Enter description'),

                    ])
                    ->columns(2)
                    ->columnSpan(2),


            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Position Name')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListBarangayOfficialPositions::route('/'),
            'create' => Pages\CreateBarangayOfficialPosition::route('/create'),
            'edit' => Pages\EditBarangayOfficialPosition::route('/{record}/edit'),
        ];
    }
}
