<?php

namespace App\Filament\Admin\Resources\Pets\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('owner_id')
                    ->required()
                    ->numeric(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('breed'),
                Select::make('gender')
                    ->options(['male' => 'Male', 'female' => 'Female', 'unknown' => 'Unknown'])
                    ->required(),
                DatePicker::make('date_of_birth'),
                TextInput::make('estimated_age_months')
                    ->numeric(),
                TextInput::make('color'),
                Select::make('size')
                    ->options(['small' => 'Small', 'medium' => 'Medium', 'large' => 'Large', 'extra_large' => 'Extra large']),
                TextInput::make('weight_kg')
                    ->numeric(),
                TextInput::make('microchip_number'),
                TextInput::make('national_registry_number'),
                FileUpload::make('profile_image_url')
                    ->image(),
                TextInput::make('qr_code')
                    ->required(),
                Toggle::make('is_sterilized'),
                DatePicker::make('sterilization_date'),
                Textarea::make('special_needs')
                    ->columnSpanFull(),
                Textarea::make('temperament')
                    ->columnSpanFull(),
                Select::make('status')
                    ->options([
            'active' => 'Active',
            'lost' => 'Lost',
            'found' => 'Found',
            'deceased' => 'Deceased',
            'adopted' => 'Adopted',
        ])
                    ->default('active'),
                DateTimePicker::make('lost_date'),
                Textarea::make('lost_location')
                    ->columnSpanFull(),
                Toggle::make('is_public'),
                Select::make('species')
                    ->options([
            'perro' => 'Perro',
            'gato' => 'Gato',
            'raton' => 'Raton',
            'conejo' => 'Conejo',
            'serpiente' => 'Serpiente',
            'vaca' => 'Vaca',
            'burro' => 'Burro',
            'caballo' => 'Caballo',
            'asno' => 'Asno',
            'gallina' => 'Gallina',
            'cerdo' => 'Cerdo',
            'loro' => 'Loro',
            'tortuga' => 'Tortuga',
            'iguana' => 'Iguana',
            'araña' => 'Araña',
        ])
                    ->default('perro')
                    ->required(),
            ]);
    }
}
