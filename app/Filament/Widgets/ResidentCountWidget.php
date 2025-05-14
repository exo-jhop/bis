<?php

namespace App\Filament\Widgets;

use App\Models\Resident;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ResidentCountWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Residents', Resident::count())
                ->description('All registered residents')
                ->descriptionIcon('heroicon-o-users')
                ->color('success'),

            Stat::make('Active Voters', Resident::where('is_voter', 1)->count())
                ->description('Registered voters in the barangay')
                ->descriptionIcon('heroicon-o-check-badge')
                ->color('primary'),

            Stat::make('New Residents (Last 30 days)', Resident::where('created_at', '>=', now()->subDays(30))->count())
                ->description('Recent registrations')
                ->descriptionIcon('heroicon-o-arrow-trending-up')
                ->chart(Resident::where('created_at', '>=', now()->subDays(30))
                    ->selectRaw('count(*) as count, DAY(created_at) as day')
                    ->groupBy('day')
                    ->orderBy('day')
                    ->pluck('count', 'day')
                    ->toArray())
                ->color('info'),
        ];
    }
}
