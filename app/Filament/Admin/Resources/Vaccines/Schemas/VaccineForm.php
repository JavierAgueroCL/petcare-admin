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
                    ->required()
                    ->numeric(),
                TextInput::make('medical_record_id')
                    ->numeric(),
                TextInput::make('vaccine_name')
                    ->required(),
                Select::make('vaccine_type')
                    ->options([
            'rabies' => 'Rabies',
            'distemper' => 'Distemper',
            'parvovirus' => 'Parvovirus',
            'hepatitis' => 'Hepatitis',
            'leptospirosis' => 'Leptospirosis',
            'kennel_cough' => 'Kennel cough',
            'feline_leukemia' => 'Feline leukemia',
            'other' => 'Other',
        ])
                    ->required(),
                TextInput::make('manufacturer'),
                TextInput::make('batch_number'),
                DatePicker::make('administration_date')
                    ->required(),
                DatePicker::make('next_dose_date'),
                TextInput::make('veterinarian_id')
                    ->numeric(),
                TextInput::make('clinic_id')
                    ->numeric(),
                TextInput::make('certificate_url')
                    ->url(),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }
}
