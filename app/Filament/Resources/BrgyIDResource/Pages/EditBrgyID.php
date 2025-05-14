<?php

namespace App\Filament\Resources\BrgyIDResource\Pages;

use App\Filament\Resources\BrgyIDResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBrgyID extends EditRecord
{
    protected static string $resource = BrgyIDResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
