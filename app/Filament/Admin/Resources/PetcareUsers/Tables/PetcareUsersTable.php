<?php

namespace App\Filament\Admin\Resources\PetcareUsers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PetcareUsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('email')
                    ->label('Correo Electrónico')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('Teléfono')
                    ->searchable(),
                TextColumn::make('first_name')
                    ->label('Nombre')
                    ->searchable(),
                TextColumn::make('last_name')
                    ->label('Apellido')
                    ->searchable(),
                TextColumn::make('rut')
                    ->label('RUT')
                    ->searchable(),
                TextColumn::make('date_of_birth')
                    ->label('Fecha de Nacimiento')
                    ->date()
                    ->sortable(),
                ImageColumn::make('profile_image_url')
                    ->label('Imagen de Perfil'),
                TextColumn::make('commune')
                    ->label('Comuna')
                    ->searchable(),
                TextColumn::make('region')
                    ->label('Región')
                    ->searchable(),
                TextColumn::make('role')
                    ->label('Rol')
                    ->badge(),
                IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean(),
                IconColumn::make('email_verified')
                    ->label('Email Verificado')
                    ->boolean(),
                IconColumn::make('phone_verified')
                    ->label('Teléfono Verificado')
                    ->boolean(),
                TextColumn::make('last_login')
                    ->label('Último Inicio de Sesión')
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
                TextColumn::make('language')
                    ->label('Idioma')
                    ->searchable(),
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
