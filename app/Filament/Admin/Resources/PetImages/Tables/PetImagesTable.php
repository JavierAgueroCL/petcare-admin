<?php

namespace App\Filament\Admin\Resources\PetImages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PetImagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pet_id')
                    ->label('Mascota')
                    ->numeric()
                    ->sortable(),
                ImageColumn::make('image_url')
                    ->label('Imagen'),
                ImageColumn::make('image_type')
                    ->label('Tipo de Imagen')
                    ->badge(),
                TextColumn::make('description')
                    ->label('Descripción')
                    ->searchable(),
                IconColumn::make('is_primary')
                    ->label('Principal')
                    ->boolean(),
                TextColumn::make('uploaded_at')
                    ->label('Fecha de Subida')
                    ->dateTime()
                    ->sortable(),
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
