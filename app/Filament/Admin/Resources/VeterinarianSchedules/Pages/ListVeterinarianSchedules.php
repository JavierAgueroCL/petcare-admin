<?php

namespace App\Filament\Admin\Resources\VeterinarianSchedules\Pages;

use App\Filament\Admin\Resources\VeterinarianSchedules\VeterinarianScheduleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVeterinarianSchedules extends ListRecords
{
    protected static string $resource = VeterinarianScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
