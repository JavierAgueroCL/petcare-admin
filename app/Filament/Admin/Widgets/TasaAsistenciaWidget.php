<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Appointment;
use App\Models\MedicalRecord;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;

class TasaAsistenciaWidget extends BaseWidget
{
    protected static bool $isDiscovered = false;
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';

    public static function canView(): bool
    {
        $user = auth()->user();
        return $user->hasRole(['admin', 'veterinaria']);
    }

    protected function getStats(): array
    {
        $query = Appointment::query()
            ->when(
                auth()->user()->hasRole('veterinaria'),
                fn(Builder $q) => $q->where('veterinarian_id', auth()->id())
            );

        $completed = $query->clone()->where('status', 'completed')->count();
        $cancelled = $query->clone()->where('status', 'cancelled')->count();
        $total = $completed + $cancelled;

        $percentage = $total > 0 ? round(($completed / $total) * 100, 1) : 0;

        // Promedios de costo
        $appointmentQuery = Appointment::query()
            ->when(
                auth()->user()->hasRole('veterinaria'),
                fn (Builder $q) => $q->where('veterinarian_id', auth()->id())
            );

        $medicalRecordQuery = MedicalRecord::query()
            ->when(
                auth()->user()->hasRole('veterinaria'),
                fn (Builder $q) => $q->where('veterinarian_id', auth()->id())
            );

        $avgAppointment = $appointmentQuery->avg('cost') ?? 0;
        $avgMedicalRecord = $medicalRecordQuery->avg('cost') ?? 0;

        return [
            Stat::make('Tasa de Asistencia', $percentage . '%')
                ->description('Completadas vs Canceladas')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color($percentage >= 80 ? 'success' : ($percentage >= 60 ? 'warning' : 'danger'))
                ->chart([$completed, $cancelled]),
            Stat::make('Promedio por Cita', '$' . number_format($avgAppointment, 0, ',', '.'))
                ->description('Costo promedio de citas')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('success'),
            Stat::make('Promedio por Registro Médico', '$' . number_format($avgMedicalRecord, 0, ',', '.'))
                ->description('Costo promedio de registros')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('info'),
        ];
    }
}
