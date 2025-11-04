<?php

namespace App\Filament\Admin\Resources\MedicalRecords\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MedicalRecordsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pet_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('veterinarian_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('clinic_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('record_type')
                    ->badge(),
                TextColumn::make('date')
                    ->date()
                    ->sortable(),
                TextColumn::make('weight_kg')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('temperature_celsius')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('heart_rate')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('next_appointment')
                    ->date()
                    ->sortable(),
                TextColumn::make('cost')
                    ->money()
                    ->sortable(),
                IconColumn::make('is_encrypted')
                    ->boolean(),
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
