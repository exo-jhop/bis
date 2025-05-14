<?php

namespace App\Filament\Resources\PurokResource\Pages;

use App\Filament\Resources\PurokResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPurok extends EditRecord
{
    protected static string $resource = PurokResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
