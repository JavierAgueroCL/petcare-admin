<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Appointment;
use App\Models\MedicalRecord;
use Filament\Widgets\ChartWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class IngresosMensualesWidget extends ChartWidget
{
    protected static bool $isDiscovered = false;
    protected ?string $heading = 'Ingresos Mensuales';
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 1;

    public static function canView(): bool
    {
        $user = auth()->user();
        return $user->hasRole(['admin', 'veterinaria']);
    }

    protected function getData(): array
    {
        $months = [];
        $appointmentData = [];
        $medicalRecordData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->format('M Y');

            $appointmentIncome = Appointment::query()
                ->when(
                    auth()->user()->hasRole('veterinaria'),
                    fn (Builder $q) => $q->where('veterinarian_id', auth()->id())
                )
                ->whereYear('appointment_datetime', $date->year)
                ->whereMonth('appointment_datetime', $date->month)
                ->sum('cost') ?? 0;

            $medicalRecordIncome = MedicalRecord::query()
                ->when(
                    auth()->user()->hasRole('veterinaria'),
                    fn (Builder $q) => $q->where('veterinarian_id', auth()->id())
                )
                ->whereYear('date', $date->year)
                ->whereMonth('date', $date->month)
                ->sum('cost') ?? 0;

            $appointmentData[] = $appointmentIncome;
            $medicalRecordData[] = $medicalRecordIncome;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Citas',
                    'data' => $appointmentData,
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                ],
                [
                    'label' => 'Registros Médicos',
                    'data' => $medicalRecordData,
                    'borderColor' => '#10b981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                ],
            ],
            'labels' => $months,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
