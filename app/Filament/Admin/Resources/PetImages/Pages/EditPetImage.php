<?php

namespace App\Filament\Admin\Resources\PetImages\Pages;

use App\Filament\Admin\Resources\PetImages\PetImageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPetImage extends EditRecord
{
    protected static string $resource = PetImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
