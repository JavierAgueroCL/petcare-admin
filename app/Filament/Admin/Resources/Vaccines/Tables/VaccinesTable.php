<?php

namespace App\Filament\Admin\Resources\Vaccines\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VaccinesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pet_id')
                    ->label('Mascota')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('medical_record_id')
                    ->label('Registro Médico')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('vaccine_name')
                    ->label('Nombre de la Vacuna')
                    ->searchable(),
                TextColumn::make('vaccine_type')
                    ->label('Tipo de Vacuna')
                    ->badge(),
                TextColumn::make('manufacturer')
                    ->label('Fabricante')
                    ->searchable(),
                TextColumn::make('batch_number')
                    ->label('Número de Lote')
                    ->searchable(),
                TextColumn::make('administration_date')
                    ->label('Fecha de Administración')
                    ->date()
                    ->sortable(),
                TextColumn::make('next_dose_date')
                    ->label('Fecha de Próxima Dosis')
                    ->date()
                    ->sortable(),
                TextColumn::make('veterinarian_id')
                    ->label('Veterinario')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('clinic_id')
                    ->label('Clínica')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('certificate_url')
                    ->label('URL del Certificado')
                    ->searchable(),
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
