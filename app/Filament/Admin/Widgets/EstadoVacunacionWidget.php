<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Vaccine;
use Filament\Widgets\ChartWidget;
use Illuminate\Database\Eloquent\Builder;

class EstadoVacunacionWidget extends ChartWidget
{
    protected static bool $isDiscovered = false;
    protected ?string $heading = 'Estado de Vacunación';
    protected static ?int $sort = 7;
    protected int | string | array $columnSpan = 1;

    public static function canView(): bool
    {
        $user = auth()->user();
        return $user->hasRole(['admin', 'veterinaria']);
    }

    protected function getData(): array
    {
        $query = Vaccine::query()
            ->when(
                auth()->user()->hasRole('veterinaria'),
                function (Builder $query) {
                    $query->whereHas('pet', function (Builder $q) {
                        $q->whereHas('appointments', function (Builder $a) {
                            $a->where('veterinarian_id', auth()->id());
                        })->orWhereHas('medicalRecords', function (Builder $m) {
                            $m->where('veterinarian_id', auth()->id());
                        });
                    });
                }
            );

        $alDia = $query->clone()
            ->where(function ($q) {
                $q->whereNull('next_dose_date')
                    ->orWhere('next_dose_date', '>', today());
            })
            ->count();

        $vencidas = $query->clone()
            ->where('next_dose_date', '<=', today())
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Vacunas',
                    'data' => [$alDia, $vencidas],
                    'backgroundColor' => ['#10b981', '#ef4444'],
                ],
            ],
            'labels' => ['Al Día', 'Pendientes/Vencidas'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
