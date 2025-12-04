<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Pet;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MascotasPerdidasWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    public static function canView(): bool
    {
        $user = auth()->user();
        return $user->hasRole('admin');
    }

    protected function getStats(): array
    {
        $count = Pet::where('status', 'lost')->count();

        return [
            Stat::make('Mascotas Reportadas como Perdidas', $count)
                ->description('Mascotas actualmente perdidas')
                ->descriptionIcon('heroicon-o-exclamation-triangle')
                ->color($count > 0 ? 'danger' : 'success')
                ->chart([7, 3, 4, 5, 6, $count, $count]),
        ];
    }
}
