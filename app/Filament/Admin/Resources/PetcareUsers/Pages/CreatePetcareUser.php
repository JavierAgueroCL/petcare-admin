<?php

namespace App\Filament\Admin\Resources\PetcareUsers\Pages;

use App\Filament\Admin\Resources\PetcareUsers\PetcareUserResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePetcareUser extends CreateRecord
{
    protected static string $resource = PetcareUserResource::class;
}
