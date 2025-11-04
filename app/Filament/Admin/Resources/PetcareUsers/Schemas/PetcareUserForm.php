<?php

namespace App\Filament\Admin\Resources\PetcareUsers\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PetcareUserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->required(),
                TextInput::make('phone')
                    ->tel(),
                TextInput::make('first_name')
                    ->required(),
                TextInput::make('last_name')
                    ->required(),
                TextInput::make('rut'),
                DatePicker::make('date_of_birth'),
                FileUpload::make('profile_image_url')
                    ->image(),
                Textarea::make('address')
                    ->columnSpanFull(),
                TextInput::make('commune'),
                TextInput::make('region'),
                Select::make('role')
                    ->options([
            'owner' => 'Owner',
            'veterinarian' => 'Veterinarian',
            'ngo' => 'Ngo',
            'municipality' => 'Municipality',
            'admin' => 'Admin',
        ])
                    ->default('owner')
                    ->required(),
                Toggle::make('is_active'),
                Toggle::make('email_verified'),
                Toggle::make('phone_verified'),
                DateTimePicker::make('last_login'),
                TextInput::make('language')
                    ->default('es'),
                TextInput::make('notification_settings'),
                TextInput::make('preferences'),
            ]);
    }
}
