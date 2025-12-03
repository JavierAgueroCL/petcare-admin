<?php

namespace App\Filament\Admin\Resources\Clinics\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ClinicForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                Section::make('Información General')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre de la Clínica')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Descripción')
                            ->rows(3)
                            ->columnSpanFull(),

                        Toggle::make('is_active')
                            ->label('Activa')
                            ->default(true)
                            ->inline(false),
                    ])
                    ->columns(2)
                    ->columnSpan(2),

                Section::make('Información de Contacto')
                    ->schema([
                        TextInput::make('phone')
                            ->label('Teléfono')
                            ->tel()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),
                    ])
                    ->columns(2)
                    ->columnSpan(2),

                Section::make('Dirección')
                    ->schema([
                        TextInput::make('address')
                            ->label('Dirección')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('commune')
                            ->label('Comuna')
                            ->maxLength(255),

                        TextInput::make('region')
                            ->label('Región')
                            ->maxLength(255),
                    ])
                    ->columns(2)
                    ->columnSpan(2),

                Section::make('Veterinarios')
                    ->schema([
                        Select::make('veterinarians')
                            ->label('Veterinarios Asignados')
                            ->relationship('veterinarians', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->helperText('Selecciona los veterinarios que trabajan en esta clínica')
                            ->columnSpanFull(),
                    ])
                    ->columnSpan(2),
            ]);
    }
}
