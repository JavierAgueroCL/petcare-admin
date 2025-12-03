<?php

namespace App\Filament\Admin\Resources\Appointments\Schemas;

use App\Models\VeterinarianSchedule;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AppointmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                Section::make('Información del Cliente')
                    ->schema([
                        Select::make('user_id')
                            ->label('Cliente')
                            ->relationship(
                                name: 'user',
                                modifyQueryUsing: fn ($query) => $query->orderBy('first_name')->orderBy('last_name')
                            )
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->name)
                            ->searchable(['first_name', 'last_name', 'email'])
                            ->preload()
                            ->required()
                            ->live(),

                        Select::make('pet_id')
                            ->label('Mascota')
                            ->relationship('pet', 'name', function ($query, Get $get) {
                                $userId = $get('user_id');
                                if ($userId) {
                                    return $query->where('owner_id', $userId);
                                }
                                return $query;
                            })
                            ->searchable()
                            ->preload()
                            ->required()
                            ->disabled(fn (Get $get) => !$get('user_id'))
                            ->helperText('Selecciona primero un cliente'),
                    ])
                    ->columns(2)
                    ->columnSpan(2),

                Section::make('Detalles de la Cita')
                    ->schema([
                        Select::make('appointment_type')
                            ->label('Tipo de Cita')
                            ->options([
                                'checkup' => 'Revisión',
                                'vaccine' => 'Vacuna',
                                'grooming' => 'Peluquería',
                                'emergency' => 'Emergencia',
                                'surgery' => 'Cirugía',
                                'other' => 'Otro',
                            ])
                            ->required()
                            ->native(false),

                        DateTimePicker::make('appointment_datetime')
                            ->label('Fecha y Hora')
                            ->required()
                            ->seconds(false)
                            ->native(false)
                            ->helperText('Selecciona una fecha y hora dentro del horario del veterinario'),

                        Select::make('status')
                            ->label('Estado')
                            ->options([
                                'scheduled' => 'Programada',
                                'confirmed' => 'Confirmada',
                                'completed' => 'Completada',
                                'cancelled' => 'Cancelada',
                            ])
                            ->default('scheduled')
                            ->required()
                            ->native(false),

                        TextInput::make('cost')
                            ->label('Costo')
                            ->numeric()
                            ->prefix('$')
                            ->minValue(0),
                    ])
                    ->columns(2)
                    ->columnSpan(2),

                Section::make('Información del Veterinario')
                    ->schema([
                        Select::make('veterinarian_id')
                            ->label('Veterinario')
                            ->options(function () {
                                return \App\Models\User::whereHas('roles', function ($query) {
                                    $query->where('name', 'veterinaria');
                                })->pluck('name', 'id');
                            })
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state) {
                                    $vet = \App\Models\User::find($state);
                                    if ($vet) {
                                        $set('veterinarian_name', $vet->name);
                                    }
                                }
                            })
                            ->helperText('Selecciona el veterinario que atenderá'),

                        TextInput::make('veterinarian_name')
                            ->label('Nombre del Veterinario')
                            ->disabled()
                            ->dehydrated(),

                        TextInput::make('clinic_name')
                            ->label('Nombre de la Clínica')
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpan(2),

                Section::make('Notas Adicionales')
                    ->schema([
                        Textarea::make('notes')
                            ->label('Notas')
                            ->rows(3)
                            ->columnSpanFull(),

                        Toggle::make('reminder_sent')
                            ->label('Recordatorio Enviado')
                            ->default(false)
                            ->inline(false),
                    ])
                    ->columnSpan(2),
            ]);
    }
}
