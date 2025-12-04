<?php

namespace App\Filament\Admin\Widgets;

use App\Models\PetcareUser;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalUsuariosWidget extends BaseWidget
{
    protected static bool $isDiscovered = false;
    protected static ?int $sort = 11;
    protected int | string | array $columnSpan = 1;

    public static function canView(): bool
    {
        $user = auth()->user();
        return $user->hasRole('admin');
    }

    protected function getStats(): array
    {
        $total = PetcareUser::count();
        $active = PetcareUser::where('is_active', true)->count();

        return [
            Stat::make('Total de Usuarios', number_format($total, 0, ',', '.'))
                ->description($active . ' usuarios activos')
                ->descriptionIcon('heroicon-o-user-group')
                ->color('success'),
        ];
    }
}
