<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Pet;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CrecimientoMensualWidget extends BaseWidget
{
    protected static bool $isDiscovered = false;
    protected static ?int $sort = 13;
    protected int | string | array $columnSpan = 1;

    public static function canView(): bool
    {
        $user = auth()->user();
        return $user->hasRole('admin');
    }

    protected function getStats(): array
    {
        $currentMonth = Pet::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();

        $lastMonth = Pet::whereYear('created_at', now()->subMonth()->year)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->count();

        $growth = $lastMonth > 0 ? round((($currentMonth - $lastMonth) / $lastMonth) * 100, 1) : 0;
        $icon = $growth >= 0 ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down';
        $color = $growth >= 0 ? 'success' : 'danger';

        return [
            Stat::make('Crecimiento Mensual', $growth . '%')
                ->description($currentMonth . ' mascotas este mes vs ' . $lastMonth . ' el mes anterior')
                ->descriptionIcon($icon)
                ->color($color)
                ->chart([$lastMonth, $currentMonth]),
        ];
    }
}
