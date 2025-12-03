<?php

namespace App\Filament\Admin\Resources\LegalContents\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LegalContentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')
                    ->label('Tipo')
                    ->options(['terms' => 'Términos y Condiciones', 'privacy' => 'Política de Privacidad'])
                    ->required(),
                Textarea::make('content')
                    ->label('Contenido')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('version')
                    ->label('Versión')
                    ->required()
                    ->default('1.0.0'),
                Toggle::make('is_active')
                    ->label('Activo'),
                DatePicker::make('effective_date')
                    ->label('Fecha de Vigencia'),
            ]);
    }
}
