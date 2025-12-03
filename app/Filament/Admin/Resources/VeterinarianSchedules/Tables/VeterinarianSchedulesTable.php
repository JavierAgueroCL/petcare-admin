<?php

namespace App\Filament\Admin\Resources\VeterinarianSchedules\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class VeterinarianSchedulesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Veterinario')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('clinic.name')
                    ->label('Clínica')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),

                TextColumn::make('day_of_week')
                    ->label('Día')
                    ->formatStateUsing(fn ($state) => [
                        0 => 'Domingo',
                        1 => 'Lunes',
                        2 => 'Martes',
                        3 => 'Miércoles',
                        4 => 'Jueves',
                        5 => 'Viernes',
                        6 => 'Sábado',
                    ][$state] ?? '')
                    ->sortable()
                    ->badge()
                    ->color(fn ($state) => match($state) {
                        1, 2, 3, 4, 5 => 'success',
                        6 => 'warning',
                        0 => 'danger',
                    }),

                TextColumn::make('start_time')
                    ->label('Hora Inicio')
                    ->time('H:i')
                    ->sortable(),

                TextColumn::make('end_time')
                    ->label('Hora Fin')
                    ->time('H:i')
                    ->sortable(),

                TextColumn::make('consultation_duration')
                    ->label('Duración Consulta')
                    ->formatStateUsing(fn ($state) => $state . ' min')
                    ->sortable()
                    ->alignCenter(),

                IconColumn::make('is_active')
                    ->label('Estado')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('day_of_week', 'asc')
            ->filters([
                SelectFilter::make('clinic_id')
                    ->label('Clínica')
                    ->relationship('clinic', 'name')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('day_of_week')
                    ->label('Día de la Semana')
                    ->options([
                        0 => 'Domingo',
                        1 => 'Lunes',
                        2 => 'Martes',
                        3 => 'Miércoles',
                        4 => 'Jueves',
                        5 => 'Viernes',
                        6 => 'Sábado',
                    ]),

                SelectFilter::make('is_active')
                    ->label('Estado')
                    ->options([
                        1 => 'Activo',
                        0 => 'Inactivo',
                    ]),
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
