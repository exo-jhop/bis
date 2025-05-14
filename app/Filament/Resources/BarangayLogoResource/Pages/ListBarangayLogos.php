<?php

namespace App\Filament\Resources\BarangayLogoResource\Pages;

use App\Filament\Resources\BarangayLogoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBarangayLogos extends ListRecords
{
    protected static string $resource = BarangayLogoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
