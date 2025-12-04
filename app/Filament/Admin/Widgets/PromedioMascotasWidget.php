<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Pet;
use App\Models\PetcareUser;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PromedioMascotasWidget extends BaseWidget
{
    protected static bool $isDiscovered = false;
    protected static ?int $sort = 12;
    protected int | string | array $columnSpan = 1;

    public static function canView(): bool
    {
        $user = auth()->user();
        return $user->hasRole('admin');
    }

    protected function getStats(): array
    {
        $totalPets = Pet::count();
        $totalUsers = PetcareUser::count();
        $average = $totalUsers > 0 ? round($totalPets / $totalUsers, 1) : 0;

        return [
            Stat::make('Promedio de Mascotas por Usuario', $average)
                ->description('Mascotas/Usuario')
                ->descriptionIcon('heroicon-o-chart-bar')
                ->color('info'),
        ];
    }
}
