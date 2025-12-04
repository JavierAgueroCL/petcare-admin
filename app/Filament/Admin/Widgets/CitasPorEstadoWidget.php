<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Appointment;
use Filament\Widgets\ChartWidget;
use Illuminate\Database\Eloquent\Builder;

class CitasPorEstadoWidget extends ChartWidget
{
    protected static bool $isDiscovered = false;
    protected ?string $heading = 'Citas por Estado';
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 1;

    public static function canView(): bool
    {
        $user = auth()->user();
        return $user->hasRole(['admin', 'veterinaria']);
    }

    protected function getData(): array
    {
        $query = Appointment::query()
            ->when(
                auth()->user()->hasRole('veterinaria'),
                fn(Builder $q) => $q->where('veterinarian_id', auth()->id())
            );

        $scheduled = $query->clone()->where('status', 'scheduled')->count();
        $confirmed = $query->clone()->where('status', 'confirmed')->count();
        $completed = $query->clone()->where('status', 'completed')->count();
        $cancelled = $query->clone()->where('status', 'cancelled')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Citas',
                    'data' => [$scheduled, $confirmed, $completed, $cancelled],
                    'backgroundColor' => ['#fbbf24', '#3b82f6', '#10b981', '#ef4444'],
                ],
            ],
            'labels' => ['Programadas', 'Confirmadas', 'Completadas', 'Canceladas'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
