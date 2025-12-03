<?php

namespace App\Filament\Admin\Resources\PetImages\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PetImageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('pet_id')
                    ->label('Mascota')
                    ->required()
                    ->numeric(),
                FileUpload::make('image_url')
                    ->label('Imagen')
                    ->image()
                    ->required(),
                Select::make('image_type')
                    ->label('Tipo de Imagen')
                    ->options(['profile' => 'Perfil', 'medical' => 'Médica', 'general' => 'General'])
                    ->default('general'),
                TextInput::make('description')
                    ->label('Descripción'),
                Toggle::make('is_primary')
                    ->label('Principal'),
                DateTimePicker::make('uploaded_at')
                    ->label('Fecha de Subida')
                    ->required(),
            ]);
    }
}
