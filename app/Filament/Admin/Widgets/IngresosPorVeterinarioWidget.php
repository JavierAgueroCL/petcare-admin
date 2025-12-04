<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Appointment;
use App\Models\User;
use Filament\Widgets\ChartWidget;
use Illuminate\Database\Eloquent\Builder;

class IngresosPorVeterinarioWidget extends ChartWidget
{
    protected static bool $isDiscovered = false;
    protected ?string $heading = 'Ingresos por Veterinario';
    protected static ?int $sort = 5;
    protected int | string | array $columnSpan = 1;

    public static function canView(): bool
    {
        $user = auth()->user();
        return $user->hasRole(['admin', 'veterinaria']);
    }

    protected function getData(): array
    {
        $veterinarians = User::whereHas('roles', function ($query) {
            $query->where('name', 'veterinaria');
        })
        ->when(
            auth()->user()->hasRole('veterinaria'),
            fn (Builder $q) => $q->where('id', auth()->id())
        )
        ->get();

        $labels = [];
        $data = [];

        foreach ($veterinarians as $vet) {
            $income = Appointment::where('veterinarian_id', $vet->id)
                ->sum('cost') ?? 0;

            $labels[] = $vet->name;
            $data[] = $income;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Ingresos (CLP)',
                    'data' => $data,
                    'backgroundColor' => '#f59e0b',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
