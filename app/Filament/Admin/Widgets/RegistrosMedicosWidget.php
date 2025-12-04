<?php

namespace App\Filament\Admin\Widgets;

use App\Models\MedicalRecord;
use Filament\Widgets\ChartWidget;
use Illuminate\Database\Eloquent\Builder;

class RegistrosMedicosWidget extends ChartWidget
{
    protected static bool $isDiscovered = false;
    protected ?string $heading = 'Registros Médicos por Tipo';
    protected static ?int $sort = 9;
    protected int | string | array $columnSpan = 'full';

    public static function canView(): bool
    {
        $user = auth()->user();
        return $user->hasRole(['admin', 'veterinaria']);
    }

    protected function getData(): array
    {
        $query = MedicalRecord::query()
            ->when(
                auth()->user()->hasRole('veterinaria'),
                fn (Builder $q) => $q->where('veterinarian_id', auth()->id())
            );

        $consultation = $query->clone()->where('record_type', 'consultation')->count();
        $surgery = $query->clone()->where('record_type', 'surgery')->count();
        $emergency = $query->clone()->where('record_type', 'emergency')->count();
        $vaccination = $query->clone()->where('record_type', 'vaccination')->count();
        $checkup = $query->clone()->where('record_type', 'checkup')->count();
        $other = $query->clone()->where('record_type', 'other')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Registros',
                    'data' => [$consultation, $surgery, $emergency, $vaccination, $checkup, $other],
                    'backgroundColor' => '#8b5cf6',
                ],
            ],
            'labels' => ['Consulta', 'Cirugía', 'Emergencia', 'Vacunación', 'Revisión', 'Otro'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
