<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\CalendarWidget;
use App\Filament\Widgets\ResidentCountWidget;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\AccountWidget;

class CustomDashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    // Override the getWidgets() method as non-static to match the parent class signature
    public function getWidgets(): array
    {
        return [
            AccountWidget::class,
            ResidentCountWidget::class,
            CalendarWidget::class,
        ];
    }
}
