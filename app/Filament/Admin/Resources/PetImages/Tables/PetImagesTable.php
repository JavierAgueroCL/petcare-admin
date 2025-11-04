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
                    ->numeric()
                    ->sortable(),
                ImageColumn::make('image_url'),
                ImageColumn::make('image_type')
                    ->badge(),
                TextColumn::make('description')
                    ->searchable(),
                IconColumn::make('is_primary')
                    ->boolean(),
                TextColumn::make('uploaded_at')
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
