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
                    ->label('Correo Electrónico')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->label('Contraseña')
                    ->password()
                    ->required(),
                TextInput::make('phone')
                    ->label('Teléfono')
                    ->tel(),
                TextInput::make('first_name')
                    ->label('Nombre')
                    ->required(),
                TextInput::make('last_name')
                    ->label('Apellido')
                    ->required(),
                TextInput::make('rut')
                    ->label('RUT'),
                DatePicker::make('date_of_birth')
                    ->label('Fecha de Nacimiento'),
                FileUpload::make('profile_image_url')
                    ->label('Imagen de Perfil')
                    ->image(),
                Textarea::make('address')
                    ->label('Dirección')
                    ->columnSpanFull(),
                TextInput::make('commune')
                    ->label('Comuna'),
                TextInput::make('region')
                    ->label('Región'),
                Select::make('role')
                    ->label('Rol')
                    ->options([
            'owner' => 'Propietario',
            'veterinarian' => 'Veterinario',
            'ngo' => 'ONG',
            'municipality' => 'Municipalidad',
            'admin' => 'Administrador',
        ])
                    ->default('owner')
                    ->required(),
                Toggle::make('is_active')
                    ->label('Activo'),
                Toggle::make('email_verified')
                    ->label('Email Verificado'),
                Toggle::make('phone_verified')
                    ->label('Teléfono Verificado'),
                DateTimePicker::make('last_login')
                    ->label('Último Inicio de Sesión'),
                TextInput::make('language')
                    ->label('Idioma')
                    ->default('es'),
                TextInput::make('notification_settings')
                    ->label('Configuración de Notificaciones'),
                TextInput::make('preferences')
                    ->label('Preferencias'),
            ]);
    }
}
