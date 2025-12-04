<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Vaccine;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class VacunasProximasWidget extends TableWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    public static function canView(): bool
    {
        $user = auth()->user();
        return $user->hasRole(['admin', 'veterinaria']);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Vacunas Próximas a Vencer (30 días)')
            ->query(
                Vaccine::query()
                    ->whereNotNull('next_dose_date')
                    ->whereBetween('next_dose_date', [today(), today()->addDays(30)])
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
                    )
                    ->orderBy('next_dose_date')
            )
            ->columns([
                TextColumn::make('next_dose_date')
                    ->label('Fecha')
                    ->date('d/m/Y')
                    ->sortable()
                    ->color(fn ($record) => $record->next_dose_date->isPast() ? 'danger' :
                        ($record->next_dose_date->diffInDays(today()) <= 7 ? 'warning' : 'success')),
                TextColumn::make('pet.name')
                    ->label('Mascota')
                    ->searchable(),
                TextColumn::make('pet.species')
                    ->label('Especie')
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                TextColumn::make('vaccine_name')
                    ->label('Vacuna')
                    ->searchable(),
                TextColumn::make('vaccine_type')
                    ->label('Tipo')
                    ->searchable(),
                TextColumn::make('pet.owner.name')
                    ->label('Propietario')
                    ->searchable(),
            ])
            ->defaultPaginationPageOption(5)
            ->paginated([5, 10, 25]);
    }
}
