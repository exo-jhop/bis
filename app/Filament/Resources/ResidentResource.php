<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResidentResource\Pages;
use App\Filament\Resources\ResidentResource\RelationManagers;
use App\Models\Purok;
use App\Models\Resident;
use BcMath\Number;
use DateTime;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ResidentResource extends Resource
{
    protected static ?string $model = Resident::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Personal Information')
                    ->collapsible()
                    ->schema([
                        TextInput::make('first_name')
                            ->required()
                            ->label('First Name')
                            ->placeholder('Enter first name')
                            ->prefixIcon('heroicon-o-identification'), // 👤 Icon for personal name

                        TextInput::make('middle_name')
                            ->label('Middle Name')
                            ->placeholder('Enter middle name')
                            ->prefixIcon('heroicon-o-identification'),

                        TextInput::make('last_name')
                            ->required()
                            ->label('Last Name')
                            ->placeholder('Enter last name')
                            ->prefixIcon('heroicon-o-identification'),

                        Select::make('gender')
                            ->label('Gender')
                            ->required()
                            ->placeholder('🚻Select gender') // emoji used here — Select may not fully support prefixIcon
                            ->options([
                                'Male' => 'Male',
                                'Female' => 'Female',
                                'Other' => 'Other',
                            ]),

                        DatePicker::make('birth_date')
                            ->label('Birth Date')
                            ->placeholder('Select birth date')
                            ->format('Y-m-d')
                            ->displayFormat('F j, Y')
                            ->prefixIcon('heroicon-o-calendar'),

                    ])->columns(2),

                Section::make('Contact Information')
                    ->collapsible()
                    ->schema([
                        TextInput::make('phone_number')
                            ->label('Phone Number')
                            ->placeholder('Enter phone number')
                            ->prefixIcon('heroicon-o-phone')
                            ->required()
                            ->tel(),

                        TextInput::make('email')
                            ->label('Email')
                            ->placeholder('Enter email address')
                            ->email()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                    ])->columns(2),

                Section::make('Status Information')
                    ->collapsible()
                    ->schema([
                        Select::make('civil_status')
                            ->label('Civil Status')
                            ->required()
                            ->placeholder('Select civil status')
                            ->options([
                                'Single' => 'Single',
                                'Married' => 'Married',
                                'Widowed' => 'Widowed',
                                'Divorced' => 'Divorced',
                            ]),

                        TextInput::make('occupation')
                            ->label('Occupation')
                            ->placeholder('Enter occupation'),

                        Toggle::make('is_voter')
                            ->label('Is Voter?')
                            ->default(false)
                            ->inline()
                            ->onColor('success')
                            ->offColor('danger'),
                    ]),

                Section::make('Address Information')
                    ->collapsible()
                    ->schema([
                        Select::make('barangay_id')
                            ->relationship('barangay', 'name')
                            ->label('Barangay')
                            ->placeholder('Select Barangay')
                            ->searchable()
                            ->reactive()
                            ->preload()
                            ->afterStateUpdated(fn(callable $set) => $set('purok_id', null)),

                        Select::make('purok_id')
                            ->label('Purok')
                            ->placeholder('Select Purok')
                            ->searchable()
                            ->reactive()
                            ->options(function ($get) {
                                $barangayId = $get('barangay_id');
                                return Purok::where('barangay_id', $barangayId)
                                    ->pluck('name', 'id');
                            }),
                    ])
            ])->columns(2);
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->orderByDesc('created_at'); // Sorting by the latest based on 'created_at' field
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('first_name')->label('First Name')->searchable()->sortable()->toggleable(),
                TextColumn::make('middle_name')->label('Middle Name')->searchable()->toggleable(),
                TextColumn::make('last_name')->label('Last Name')->searchable()->sortable()->toggleable(),
                TextColumn::make('gender')->label('Gender')->sortable()->toggleable(),

                TextColumn::make('birth_date')
                    ->label('Birth Date')
                    ->date('F j, Y')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('barangay.name')->label('Barangay')->sortable()->toggleable(),
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
            'index' => Pages\ListResidents::route('/'),
            'create' => Pages\CreateResident::route('/create'),
            'edit' => Pages\EditResident::route('/{record}/edit'),
        ];
    }
}
