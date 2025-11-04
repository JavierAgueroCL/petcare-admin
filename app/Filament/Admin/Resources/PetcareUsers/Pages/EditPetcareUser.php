<?php

namespace App\Filament\Admin\Resources\PetcareUsers\Pages;

use App\Filament\Admin\Resources\PetcareUsers\PetcareUserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPetcareUser extends EditRecord
{
    protected static string $resource = PetcareUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
