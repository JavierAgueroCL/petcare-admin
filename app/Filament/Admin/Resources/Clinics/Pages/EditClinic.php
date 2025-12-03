<?php

namespace App\Filament\Admin\Resources\Clinics\Pages;

use App\Filament\Admin\Resources\Clinics\ClinicResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditClinic extends EditRecord
{
    protected static string $resource = ClinicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
