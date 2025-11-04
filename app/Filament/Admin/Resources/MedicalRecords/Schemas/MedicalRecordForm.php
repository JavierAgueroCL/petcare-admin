<?php

namespace App\Filament\Admin\Resources\MedicalRecords\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MedicalRecordForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('pet_id')
                    ->required()
                    ->numeric(),
                TextInput::make('veterinarian_id')
                    ->numeric(),
                TextInput::make('clinic_id')
                    ->numeric(),
                Select::make('record_type')
                    ->options([
            'consultation' => 'Consultation',
            'surgery' => 'Surgery',
            'emergency' => 'Emergency',
            'vaccination' => 'Vaccination',
            'checkup' => 'Checkup',
            'other' => 'Other',
        ])
                    ->required(),
                DatePicker::make('date')
                    ->required(),
                Textarea::make('diagnosis')
                    ->columnSpanFull(),
                Textarea::make('treatment')
                    ->columnSpanFull(),
                Textarea::make('prescriptions')
                    ->columnSpanFull(),
                Textarea::make('notes')
                    ->columnSpanFull(),
                TextInput::make('weight_kg')
                    ->numeric(),
                TextInput::make('temperature_celsius')
                    ->numeric(),
                TextInput::make('heart_rate')
                    ->numeric(),
                DatePicker::make('next_appointment'),
                TextInput::make('cost')
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('attachments'),
                Toggle::make('is_encrypted'),
            ]);
    }
}
