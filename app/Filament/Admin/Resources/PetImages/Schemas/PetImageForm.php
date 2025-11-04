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
                    ->required()
                    ->numeric(),
                FileUpload::make('image_url')
                    ->image()
                    ->required(),
                Select::make('image_type')
                    ->options(['profile' => 'Profile', 'medical' => 'Medical', 'general' => 'General'])
                    ->default('general'),
                TextInput::make('description'),
                Toggle::make('is_primary'),
                DateTimePicker::make('uploaded_at')
                    ->required(),
            ]);
    }
}
