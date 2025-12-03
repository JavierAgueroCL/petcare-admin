<?php

namespace App\Filament\Admin\Resources\QrCodes\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class QrCodeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('pet_id')
                    ->label('Mascota')
                    ->required()
                    ->numeric(),
                TextInput::make('qr_code')
                    ->label('Código QR')
                    ->required(),
                FileUpload::make('qr_image_url')
                    ->label('Imagen QR')
                    ->image(),
                TextInput::make('total_scans')
                    ->label('Total de Escaneos')
                    ->numeric()
                    ->default(0),
                DateTimePicker::make('last_scanned_at')
                    ->label('Último Escaneo'),
            ]);
    }
}
