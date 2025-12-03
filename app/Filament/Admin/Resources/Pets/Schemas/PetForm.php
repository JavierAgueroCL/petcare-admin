<?php

namespace App\Filament\Admin\Resources\Pets\Schemas;

use App\Models\PetcareUser;
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
                Select::make('owner_id')
                    ->label('Propietario')
                    ->required()
                    ->searchable()
                    ->options(PetcareUser::all()->pluck('name', 'id'))
                    ->preload(),
                TextInput::make('name')
                    ->label('Nombre')
                    ->required(),
                TextInput::make('breed')
                    ->label('Raza'),
                Select::make('gender')
                    ->label('Género')
                    ->options(['male' => 'Macho', 'female' => 'Hembra', 'unknown' => 'Desconocido'])
                    ->required(),
                DatePicker::make('date_of_birth')
                    ->label('Fecha de Nacimiento'),
                TextInput::make('color')
                    ->label('Color'),
                Select::make('size')
                    ->label('Tamaño')
                    ->options(['small' => 'Pequeño', 'medium' => 'Mediano', 'large' => 'Grande', 'extra_large' => 'Extra Grande']),
                TextInput::make('weight_kg')
                    ->label('Peso (kg)')
                    ->numeric(),
                TextInput::make('microchip_number')
                    ->label('Número de Microchip'),
                TextInput::make('national_registry_number')
                    ->label('Número de Registro Nacional'),
                FileUpload::make('profile_image_url')
                    ->label('Imagen de Perfil')
                    ->image(),
                TextInput::make('qr_code')
                    ->label('Código QR')
                    ->required(),
                Toggle::make('is_sterilized')
                    ->label('Esterilizado'),
                DatePicker::make('sterilization_date')
                    ->label('Fecha de Esterilización'),
                Textarea::make('special_needs')
                    ->label('Necesidades Especiales')
                    ->columnSpanFull(),
                Textarea::make('temperament')
                    ->label('Temperamento')
                    ->columnSpanFull(),
                Select::make('status')
                    ->label('Estado')
                    ->options([
            'active' => 'Activo',
            'lost' => 'Perdido',
            'found' => 'Encontrado',
            'deceased' => 'Fallecido',
            'adopted' => 'Adoptado',
        ])
                    ->default('active'),
                DateTimePicker::make('lost_date')
                    ->label('Fecha de Pérdida'),
                Textarea::make('lost_location')
                    ->label('Ubicación de Pérdida')
                    ->columnSpanFull(),
                Toggle::make('is_public')
                    ->label('Público'),
                Select::make('species')
                    ->label('Especie')
                    ->options([
            'perro' => 'Perro',
            'gato' => 'Gato',
            'raton' => 'Ratón',
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
