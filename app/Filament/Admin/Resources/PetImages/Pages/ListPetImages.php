<?php

namespace App\Filament\Admin\Resources\PetImages\Pages;

use App\Filament\Admin\Resources\PetImages\PetImageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPetImages extends ListRecords
{
    protected static string $resource = PetImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
