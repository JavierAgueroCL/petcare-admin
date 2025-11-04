<?php

namespace App\Filament\Admin\Resources\Vaccines\Pages;

use App\Filament\Admin\Resources\Vaccines\VaccineResource;
use Filament\Resources\Pages\CreateRecord;

class CreateVaccine extends CreateRecord
{
    protected static string $resource = VaccineResource::class;
}
