<?php

namespace App\Filament\Admin\Resources\MedicalRecords\Schemas;

use App\Models\Clinic;
use App\Models\Pet;
use App\Models\PetcareUser;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MedicalRecordForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('pet_id')
                    ->label('Mascota')
                    ->required()
                    ->searchable()
                    ->options(Pet::all()->pluck('name', 'id'))
                    ->preload(),
                Select::make('veterinarian_id')
                    ->label('Veterinario')
                    ->searchable()
                    ->options(PetcareUser::where('role', 'veterinarian')->get()->pluck('name', 'id'))
                    ->preload(),
                Select::make('clinic_id')
                    ->label('Clínica')
                    ->searchable()
                    ->options(Clinic::all()->pluck('name', 'id'))
                    ->preload(),
                Select::make('record_type')
                    ->label('Tipo de Registro')
                    ->options([
                        'consultation' => 'Consulta',
                        'surgery' => 'Cirugía',
                        'emergency' => 'Emergencia',
                        'vaccination' => 'Vacunación',
                        'checkup' => 'Revisión',
                        'other' => 'Otro',
                    ])
                    ->required(),
                DatePicker::make('date')
                    ->label('Fecha')
                    ->required(),
                Textarea::make('diagnosis')
                    ->label('Diagnóstico')
                    ->columnSpanFull(),
                Textarea::make('treatment')
                    ->label('Tratamiento')
                    ->columnSpanFull(),
                Textarea::make('prescriptions')
                    ->label('Prescripciones')
                    ->columnSpanFull(),
                Textarea::make('notes')
                    ->label('Notas')
                    ->columnSpanFull(),
                TextInput::make('weight_kg')
                    ->label('Peso (kg)')
                    ->numeric(),
                TextInput::make('temperature_celsius')
                    ->label('Temperatura (°C)')
                    ->numeric(),
                TextInput::make('heart_rate')
                    ->label('Frecuencia Cardíaca')
                    ->numeric(),
                DatePicker::make('next_appointment')
                    ->label('Próxima Cita'),
                TextInput::make('cost')
                    ->label('Costo (CLP)')
                    ->numeric()
                    ->prefix('$'),
                FileUpload::make('attachments')
                    ->label('Archivos Adjuntos')
                    ->image()
                    ->multiple()
                    ->maxFiles(5)
                    ->disk('public')
                    ->directory('medical-records')
                    ->maxSize(5120)
                    ->columnSpanFull(),
            ]);
    }
}
