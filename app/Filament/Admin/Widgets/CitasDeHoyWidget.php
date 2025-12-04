<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Appointment;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class CitasDeHoyWidget extends TableWidget
{
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';

    public static function canView(): bool
    {
        $user = auth()->user();
        return $user->hasRole(['admin', 'veterinaria']);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Citas de Hoy')
            ->query(
                Appointment::query()
                    ->whereDate('appointment_datetime', today())
                    ->when(
                        auth()->user()->hasRole('veterinaria'),
                        fn (Builder $query) => $query->where('veterinarian_id', auth()->id())
                    )
                    ->orderBy('appointment_datetime')
            )
            ->columns([
                TextColumn::make('appointment_datetime')
                    ->label('Hora')
                    ->dateTime('H:i')
                    ->sortable(),
                TextColumn::make('pet.name')
                    ->label('Mascota')
                    ->searchable(),
                TextColumn::make('pet.species')
                    ->label('Especie')
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                TextColumn::make('appointment_type')
                    ->label('Tipo')
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'checkup' => 'Revisión',
                        'vaccine' => 'Vacuna',
                        'grooming' => 'Peluquería',
                        'emergency' => 'Emergencia',
                        'surgery' => 'Cirugía',
                        default => 'Otro',
                    }),
                BadgeColumn::make('status')
                    ->label('Estado')
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'scheduled' => 'Programada',
                        'confirmed' => 'Confirmada',
                        'completed' => 'Completada',
                        'cancelled' => 'Cancelada',
                        default => $state,
                    })
                    ->colors([
                        'warning' => 'scheduled',
                        'primary' => 'confirmed',
                        'success' => 'completed',
                        'danger' => 'cancelled',
                    ]),
                TextColumn::make('user.name')
                    ->label('Cliente')
                    ->searchable(),
            ])
            ->defaultPaginationPageOption(5)
            ->paginated([5, 10, 25]);
    }
}
