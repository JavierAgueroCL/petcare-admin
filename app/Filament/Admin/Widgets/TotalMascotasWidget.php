<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Pet;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalMascotasWidget extends BaseWidget
{
    protected static bool $isDiscovered = false;
    protected static ?int $sort = 10;
    protected int | string | array $columnSpan = 1;

    public static function canView(): bool
    {
        $user = auth()->user();
        return $user->hasRole('admin');
    }

    protected function getStats(): array
    {
        $total = Pet::count();
        $lastMonth = Pet::where('created_at', '>=', now()->subMonth())->count();

        return [
            Stat::make('Total de Mascotas Registradas', number_format($total, 0, ',', '.'))
                ->description($lastMonth . ' nuevas este mes')
                ->descriptionIcon('heroicon-o-arrow-trending-up')
                ->color('primary')
                ->chart([10, 15, 12, 18, 20, $lastMonth]),
        ];
    }
}
