<?php

namespace App\Filament\Admin\Resources\QrCodes\Pages;

use App\Filament\Admin\Resources\QrCodes\QrCodeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateQrCode extends CreateRecord
{
    protected static string $resource = QrCodeResource::class;
}
