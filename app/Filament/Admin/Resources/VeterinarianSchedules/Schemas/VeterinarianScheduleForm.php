<?php

namespace App\Filament\Admin\Resources\VeterinarianSchedules\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class VeterinarianScheduleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                Section::make('Información del Veterinario')
                    ->schema([
                        Select::make('user_id')
                            ->label('Veterinario')
                            ->relationship('user', 'name', function ($query) {
                                return $query->whereHas('roles', function ($q) {
                                    $q->where('name', 'veterinaria');
                                });
                            })
                            ->required()
                            ->searchable()
                            ->preload(),

                        Select::make('clinic_id')
                            ->label('Clínica')
                            ->relationship('clinic', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->helperText('Selecciona la clínica donde el veterinario atenderá'),
                    ])
                    ->columns(2)
                    ->columnSpan(2),

                Section::make('Horario de Atención')
                    ->schema([
                        Select::make('day_of_week')
                            ->label('Día de la Semana')
                            ->options([
                                0 => 'Domingo',
                                1 => 'Lunes',
                                2 => 'Martes',
                                3 => 'Miércoles',
                                4 => 'Jueves',
                                5 => 'Viernes',
                                6 => 'Sábado',
                            ])
                            ->required()
                            ->native(false),

                        TimePicker::make('start_time')
                            ->label('Hora de Inicio')
                            ->required()
                            ->seconds(false)
                            ->format('H:i'),

                        TimePicker::make('end_time')
                            ->label('Hora de Fin')
                            ->required()
                            ->seconds(false)
                            ->format('H:i')
                            ->after('start_time'),

                        TextInput::make('consultation_duration')
                            ->label('Duración de Consulta (minutos)')
                            ->required()
                            ->numeric()
                            ->default(30)
                            ->minValue(15)
                            ->maxValue(180)
                            ->suffix('min')
                            ->helperText('Tiempo estimado por consulta'),

                        Toggle::make('is_active')
                            ->label('Activo')
                            ->default(true)
                            ->inline(false)
                            ->helperText('Desactiva el horario si no está disponible temporalmente'),
                    ])
                    ->columns(2)
                    ->columnSpan(2),
            ]);
    }
}
