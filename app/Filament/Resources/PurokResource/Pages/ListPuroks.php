<?php

namespace App\Filament\Resources\PurokResource\Pages;

use App\Filament\Resources\PurokResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPuroks extends ListRecords
{
    protected static string $resource = PurokResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
