<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Appointment;
use Filament\Widgets\ChartWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class HorariosDemandadosWidget extends ChartWidget
{
    protected static bool $isDiscovered = false;
    protected ?string $heading = 'Horarios Más Demandados';
    protected static ?int $sort = 8;
    protected int | string | array $columnSpan = 'full';

    public static function canView(): bool
    {
        $user = auth()->user();
        return $user->hasRole(['admin', 'veterinaria']);
    }

    protected function getData(): array
    {
        $appointments = Appointment::query()
            ->when(
                auth()->user()->hasRole('veterinaria'),
                fn (Builder $q) => $q->where('veterinarian_id', auth()->id())
            )
            ->whereNotNull('appointment_datetime')
            ->get();

        $hourCounts = [];
        for ($i = 8; $i <= 18; $i++) {
            $hourCounts[$i] = 0;
        }

        foreach ($appointments as $appointment) {
            $hour = $appointment->appointment_datetime->hour;
            if ($hour >= 8 && $hour <= 18) {
                $hourCounts[$hour]++;
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Citas',
                    'data' => array_values($hourCounts),
                    'backgroundColor' => '#3b82f6',
                ],
            ],
            'labels' => array_map(fn($h) => $h . ':00', array_keys($hourCounts)),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
