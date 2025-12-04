<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Appointment;
use Filament\Widgets\ChartWidget;
use Illuminate\Database\Eloquent\Builder;

class TiposConsultaWidget extends ChartWidget
{
    protected static bool $isDiscovered = false;
    protected ?string $heading = 'Tipos de Consulta Más Frecuentes';
    protected static ?int $sort = 6;
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
                fn (Builder $q) => $q->where('veterinarian_id', auth()->id())
            );

        $checkup = $query->clone()->where('appointment_type', 'checkup')->count();
        $vaccine = $query->clone()->where('appointment_type', 'vaccine')->count();
        $grooming = $query->clone()->where('appointment_type', 'grooming')->count();
        $emergency = $query->clone()->where('appointment_type', 'emergency')->count();
        $surgery = $query->clone()->where('appointment_type', 'surgery')->count();
        $other = $query->clone()->where('appointment_type', 'other')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Citas',
                    'data' => [$checkup, $vaccine, $grooming, $emergency, $surgery, $other],
                    'backgroundColor' => '#10b981',
                ],
            ],
            'labels' => ['Revisión', 'Vacuna', 'Peluquería', 'Emergencia', 'Cirugía', 'Otro'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
