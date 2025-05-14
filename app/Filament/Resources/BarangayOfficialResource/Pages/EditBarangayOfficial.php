<?php

namespace App\Filament\Resources\BarangayOfficialResource\Pages;

use App\Filament\Resources\BarangayOfficialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBarangayOfficial extends EditRecord
{
    protected static string $resource = BarangayOfficialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
