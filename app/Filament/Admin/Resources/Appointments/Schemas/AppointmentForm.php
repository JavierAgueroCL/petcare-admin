<?php

namespace App\Filament\Admin\Resources\Appointments\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AppointmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('pet_id')
                    ->required()
                    ->numeric(),
                Select::make('appointment_type')
                    ->options([
            'checkup' => 'Checkup',
            'vaccine' => 'Vaccine',
            'grooming' => 'Grooming',
            'emergency' => 'Emergency',
            'surgery' => 'Surgery',
            'other' => 'Other',
        ])
                    ->required(),
                DateTimePicker::make('appointment_datetime')
                    ->required(),
                Select::make('status')
                    ->options([
            'scheduled' => 'Scheduled',
            'confirmed' => 'Confirmed',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
        ])
                    ->default('scheduled')
                    ->required(),
                TextInput::make('clinic_name'),
                TextInput::make('veterinarian_name'),
                Textarea::make('notes')
                    ->columnSpanFull(),
                TextInput::make('cost')
                    ->numeric()
                    ->prefix('$'),
                Toggle::make('reminder_sent'),
            ]);
    }
}
