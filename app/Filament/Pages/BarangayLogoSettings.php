<?php

namespace App\Filament\Pages;

use App\Models\BarangayLogo;
use Filament\Pages\Page;
use Livewire\WithFileUploads;
use Filament\Notifications\Notification;

class BarangayLogoSettings extends Page
{
    use WithFileUploads;

    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Barangay Logo';
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?int $navigationSort = 2;

    public ?BarangayLogo $barangayLogo = null;
    public $newLogo;

    public function mount(): void
    {
        $this->barangayLogo = BarangayLogo::first();
    }

    public function updateLogo()
    {
        $this->validate([
            'newLogo' => 'image|max:2048',
        ]);

        $path = $this->newLogo->store('barangay-logos', 'public');

        if ($this->barangayLogo) {
            $this->barangayLogo->update(['logo_path' => $path]);
        } else {
            $this->barangayLogo = BarangayLogo::create(['logo_path' => $path]);
        }

        $this->newLogo = null;

        Notification::make()
            ->title('Barangay logo updated!')
            ->success()
            ->body('The new logo was uploaded successfully.')
            ->send();
    }

    public function getView(): string
    {
        return 'filament.pages.barangay-logo-settings';
    }
}
