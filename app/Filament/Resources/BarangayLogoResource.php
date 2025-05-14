<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangayLogoResource\Pages;
use App\Filament\Resources\BarangayLogoResource\RelationManagers;
use App\Models\BarangayLogo;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BarangayLogoResource extends Resource
{
    protected static ?string $model = BarangayLogo::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationLabel = 'Barangay Logo';
    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Barangay Logo Information')
                    ->schema([
                        FileUpload::make('logo_path')
                            ->label('Barangay Logo')
                            ->image()
                            ->directory('barangay-logos')
                            ->required()
                            ->disk('public'),
                    ])
                    ->columns(2)
                    ->columnSpan(2),
            ]);
    }
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo_path')
                    ->label('Logo')
                    ->disk('public')
                    ->circular(),
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
            'index' => Pages\ListBarangayLogos::route('/'),
            'create' => Pages\CreateBarangayLogo::route('/create'),
            'edit' => Pages\EditBarangayLogo::route('/{record}/edit'),
        ];
    }
}
