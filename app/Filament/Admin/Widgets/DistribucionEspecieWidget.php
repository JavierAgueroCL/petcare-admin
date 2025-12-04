<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Pet;
use Filament\Widgets\ChartWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class DistribucionEspecieWidget extends ChartWidget
{
    protected static bool $isDiscovered = false;
    protected ?string $heading = 'Distribución por Especie';
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 1;

    public static function canView(): bool
    {
        $user = auth()->user();
        return $user->hasRole(['admin', 'veterinaria']);
    }

    protected function getData(): array
    {
        $query = Pet::query()
            ->when(
                auth()->user()->hasRole('veterinaria'),
                function (Builder $query) {
                    $query->whereHas('appointments', function (Builder $a) {
                        $a->where('veterinarian_id', auth()->id());
                    })->orWhereHas('medicalRecords', function (Builder $m) {
                        $m->where('veterinarian_id', auth()->id());
                    });
                }
            );

        $species = $query->select('species', DB::raw('count(*) as count'))
            ->groupBy('species')
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        $labels = $species->map(fn($s) => ucfirst($s->species))->toArray();
        $data = $species->pluck('count')->toArray();

        $colors = ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899', '#14b8a6', '#f97316', '#06b6d4', '#84cc16'];

        return [
            'datasets' => [
                [
                    'label' => 'Mascotas',
                    'data' => $data,
                    'backgroundColor' => array_slice($colors, 0, count($data)),
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
