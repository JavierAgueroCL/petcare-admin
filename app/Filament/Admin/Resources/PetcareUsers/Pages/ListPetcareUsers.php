<?php

namespace App\Filament\Admin\Resources\PetcareUsers\Pages;

use App\Filament\Admin\Resources\PetcareUsers\PetcareUserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPetcareUsers extends ListRecords
{
    protected static string $resource = PetcareUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
