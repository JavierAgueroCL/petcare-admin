<?php

namespace App\Filament\Admin\Resources\Vaccines\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class VaccineForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('pet_id')
                    ->label('Mascota')
                    ->required()
                    ->numeric(),
                TextInput::make('medical_record_id')
                    ->label('Registro Médico')
                    ->numeric(),
                TextInput::make('vaccine_name')
                    ->label('Nombre de la Vacuna')
                    ->required(),
                Select::make('vaccine_type')
                    ->label('Tipo de Vacuna')
                    ->options([
            'rabies' => 'Rabia',
            'distemper' => 'Moquillo',
            'parvovirus' => 'Parvovirus',
            'hepatitis' => 'Hepatitis',
            'leptospirosis' => 'Leptospirosis',
            'kennel_cough' => 'Tos de las Perreras',
            'feline_leukemia' => 'Leucemia Felina',
            'other' => 'Otro',
        ])
                    ->required(),
                TextInput::make('manufacturer')
                    ->label('Fabricante'),
                TextInput::make('batch_number')
                    ->label('Número de Lote'),
                DatePicker::make('administration_date')
                    ->label('Fecha de Administración')
                    ->required(),
                DatePicker::make('next_dose_date')
                    ->label('Fecha de Próxima Dosis'),
                TextInput::make('veterinarian_id')
                    ->label('Veterinario')
                    ->numeric(),
                TextInput::make('clinic_id')
                    ->label('Clínica')
                    ->numeric(),
                TextInput::make('certificate_url')
                    ->label('URL del Certificado')
                    ->url(),
                Textarea::make('notes')
                    ->label('Notas')
                    ->columnSpanFull(),
            ]);
    }
}
