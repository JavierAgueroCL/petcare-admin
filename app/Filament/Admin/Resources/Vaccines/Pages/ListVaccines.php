<?php

namespace App\Filament\Admin\Resources\Vaccines\Pages;

use App\Filament\Admin\Resources\Vaccines\VaccineResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVaccines extends ListRecords
{
    protected static string $resource = VaccineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
