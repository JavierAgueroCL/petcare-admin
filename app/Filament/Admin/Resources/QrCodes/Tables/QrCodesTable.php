<?php

namespace App\Filament\Admin\Resources\QrCodes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class QrCodesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pet_id')
                    ->label('Mascota')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('qr_code')
                    ->label('Código QR')
                    ->searchable(),
                ImageColumn::make('qr_image_url')
                    ->label('Imagen QR'),
                TextColumn::make('total_scans')
                    ->label('Total de Escaneos')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('last_scanned_at')
                    ->label('Último Escaneo')
                    ->dateTime()
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
