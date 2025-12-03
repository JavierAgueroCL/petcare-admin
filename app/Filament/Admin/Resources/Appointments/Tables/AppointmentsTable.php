<?php

namespace App\Filament\Admin\Resources\Appointments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AppointmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pet.name')
                    ->label('Mascota')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('appointment_type')
                    ->label('Tipo de Cita')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'checkup' => 'Revisión',
                        'vaccine' => 'Vacuna',
                        'grooming' => 'Peluquería',
                        'emergency' => 'Emergencia',
                        'surgery' => 'Cirugía',
                        'other' => 'Otro',
                        default => $state,
                    }),
                TextColumn::make('appointment_datetime')
                    ->label('Fecha y Hora')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'scheduled' => 'Programada',
                        'confirmed' => 'Confirmada',
                        'completed' => 'Completada',
                        'cancelled' => 'Cancelada',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'scheduled' => 'warning',
                        'confirmed' => 'info',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('clinic_name')
                    ->label('Nombre de la Clínica')
                    ->searchable(),
                TextColumn::make('veterinarian_name')
                    ->label('Nombre del Veterinario')
                    ->searchable(),
                TextColumn::make('cost')
                    ->label('Costo')
                    ->money('CLP')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Fecha de Creación')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Fecha de Actualización')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
