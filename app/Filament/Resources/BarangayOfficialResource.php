<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangayOfficialResource\Pages;
use App\Filament\Resources\BarangayOfficialResource\RelationManagers;
use App\Models\BarangayOfficial;
use App\Models\BarangayOfficialPosition;
use App\Models\Resident;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;

class BarangayOfficialResource extends Resource
{
    protected static ?string $model = BarangayOfficial::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Official Information')
                    ->schema([
                        Select::make('resident_id')
                            ->label('Resident')
                            ->options(
                                Resident::all()->mapWithKeys(function ($resident) {
                                    return [$resident->id => $resident->full_name];
                                })
                            )
                            ->prefixIcon('heroicon-o-user')
                            ->placeholder('Select Resident')
                            ->required(),

                        Select::make('position_id')
                            ->label('Position')
                            ->options(
                                BarangayOfficialPosition::all()->pluck('name', 'id')
                            )
                            ->prefixIcon('heroicon-o-briefcase')
                            ->placeholder('🏷 Select Position')
                            ->required(),

                        TextInput::make('contact_number')
                            ->label('Contact Number')
                            ->placeholder('Enter Contact Number')
                            ->tel()
                            ->prefixIcon('heroicon-o-phone'),

                        TextInput::make('email')
                            ->label('Email')
                            ->placeholder('Enter Email Address')
                            ->email()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->prefixIcon('heroicon-o-envelope'),

                        FileUpload::make('photo')
                            ->label('Profile Photo')
                            ->disk('public')
                            ->image()
                            ->imageEditor()
                            ->directory('photos')
                            ->maxSize(5024)
                            ->required(),

                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')->circular(),
                TextColumn::make('resident.full_name')->label('Name')->sortable(),
                TextColumn::make('position.name')->label('Position')->sortable(),
                TextColumn::make('contact_number')->label('Contact Number')->sortable(),
                TextColumn::make('email')->label('Email')->sortable(),
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
            'index' => Pages\ListBarangayOfficials::route('/'),
            'create' => Pages\CreateBarangayOfficial::route('/create'),
            'edit' => Pages\EditBarangayOfficial::route('/{record}/edit'),
        ];
    }
}
