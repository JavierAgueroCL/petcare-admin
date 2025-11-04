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
                    ->numeric()
                    ->sortable(),
                TextColumn::make('medical_record_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('vaccine_name')
                    ->searchable(),
                TextColumn::make('vaccine_type')
                    ->badge(),
                TextColumn::make('manufacturer')
                    ->searchable(),
                TextColumn::make('batch_number')
                    ->searchable(),
                TextColumn::make('administration_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('next_dose_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('veterinarian_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('clinic_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('certificate_url')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
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
