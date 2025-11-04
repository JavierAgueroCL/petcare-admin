<?php

namespace App\Filament\Admin\Resources\PetImages\Pages;

use App\Filament\Admin\Resources\PetImages\PetImageResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePetImage extends CreateRecord
{
    protected static string $resource = PetImageResource::class;
}
