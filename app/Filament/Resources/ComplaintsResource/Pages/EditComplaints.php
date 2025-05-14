<?php

namespace App\Filament\Resources\ComplaintsResource\Pages;

use App\Filament\Resources\ComplaintsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditComplaints extends EditRecord
{
    protected static string $resource = ComplaintsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
