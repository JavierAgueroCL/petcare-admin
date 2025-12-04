<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Pet;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MascotasNecesidadesEspecialesWidget extends BaseWidget
{
    protected static ?int $sort = 4;

    public static function canView(): bool
    {
        $user = auth()->user();
        return $user->hasRole('admin');
    }

    protected function getStats(): array
    {
        $count = Pet::whereNotNull('special_needs')
            ->where('special_needs', '!=', '')
            ->count();

        return [
            Stat::make('Mascotas con Necesidades Especiales', $count)
                ->description('Requieren atención particular')
                ->descriptionIcon('heroicon-o-heart')
                ->color('info'),
        ];
    }
}
