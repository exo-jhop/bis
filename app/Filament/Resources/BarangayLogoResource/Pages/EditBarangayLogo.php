<?php

namespace App\Filament\Resources\BarangayLogoResource\Pages;

use App\Filament\Resources\BarangayLogoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBarangayLogo extends EditRecord
{
    protected static string $resource = BarangayLogoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
