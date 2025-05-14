<?php

namespace App\Filament\Resources\BarangayOfficialPositionResource\Pages;

use App\Filament\Resources\BarangayOfficialPositionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBarangayOfficialPositions extends ListRecords
{
    protected static string $resource = BarangayOfficialPositionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
