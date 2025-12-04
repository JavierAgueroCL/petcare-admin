<?php

namespace App\Filament\Admin\Pages;

use BackedEnum;
use Filament\Pages\Page;

class Metricas extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'Métricas';
    protected static ?string $title = 'Métricas y Estadísticas';
    protected static ?int $navigationSort = 10;
    protected string $view = 'filament.admin.pages.metricas';

    public static function canAccess(): bool
    {
        $user = auth()->user();
        return $user->hasRole(['admin', 'veterinaria']);
    }

    protected function getHeaderWidgets(): array
    {
        $widgets = [];

        // Fila 1: Tasa de Asistencia | Promedio por Cita | Promedio por Registro Médico
        $widgets[] = \App\Filament\Admin\Widgets\TasaAsistenciaWidget::class;

        // Fila 2: Distribución por Especie | Citas por Estado
        $widgets[] = \App\Filament\Admin\Widgets\DistribucionEspecieWidget::class;
        $widgets[] = \App\Filament\Admin\Widgets\CitasPorEstadoWidget::class;

        // Fila 3: Ingresos Mensuales | Ingresos por Veterinario
        $widgets[] = \App\Filament\Admin\Widgets\IngresosMensualesWidget::class;
        $widgets[] = \App\Filament\Admin\Widgets\IngresosPorVeterinarioWidget::class;

        // Fila 4: Tipos de Consulta Más Frecuentes | Estado de Vacunación
        $widgets[] = \App\Filament\Admin\Widgets\TiposConsultaWidget::class;
        $widgets[] = \App\Filament\Admin\Widgets\EstadoVacunacionWidget::class;

        // Otros widgets
        $widgets[] = \App\Filament\Admin\Widgets\HorariosDemandadosWidget::class;
        $widgets[] = \App\Filament\Admin\Widgets\RegistrosMedicosWidget::class;

        // KPIs principales (solo admin)
        if (auth()->user()->hasRole('admin')) {
            $widgets[] = \App\Filament\Admin\Widgets\TotalMascotasWidget::class;
            $widgets[] = \App\Filament\Admin\Widgets\TotalUsuariosWidget::class;
            $widgets[] = \App\Filament\Admin\Widgets\PromedioMascotasWidget::class;
            $widgets[] = \App\Filament\Admin\Widgets\CrecimientoMensualWidget::class;
        }

        return $widgets;
    }

    public function getHeaderWidgetsColumns(): int | array
    {
        return 2;
    }
}
