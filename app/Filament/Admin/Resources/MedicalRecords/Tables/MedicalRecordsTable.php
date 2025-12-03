<?php

namespace App\Filament\Admin\Resources\MedicalRecords\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MedicalRecordsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pet.name')
                    ->label('Mascota')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('veterinarian.name')
                    ->label('Veterinario')
                    ->sortable()
                    ->searchable()
                    ->default('N/A'),
                TextColumn::make('clinic.name')
                    ->label('Clínica')
                    ->sortable()
                    ->searchable()
                    ->default('N/A'),
                TextColumn::make('record_type')
                    ->label('Tipo de Registro')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'consultation' => 'Consulta',
                        'surgery' => 'Cirugía',
                        'emergency' => 'Emergencia',
                        'vaccination' => 'Vacunación',
                        'checkup' => 'Revisión',
                        'other' => 'Otro',
                        default => $state,
                    }),
                TextColumn::make('date')
                    ->label('Fecha')
                    ->date()
                    ->sortable(),
                TextColumn::make('weight_kg')
                    ->label('Peso (kg)')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('temperature_celsius')
                    ->label('Temperatura (°C)')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('heart_rate')
                    ->label('Frecuencia Cardíaca')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('next_appointment')
                    ->label('Próxima Cita')
                    ->date()
                    ->sortable(),
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
