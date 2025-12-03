<?php

namespace App\Filament\Admin\Resources\VeterinarianSchedules\Pages;

use App\Filament\Admin\Resources\VeterinarianSchedules\VeterinarianScheduleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVeterinarianSchedule extends EditRecord
{
    protected static string $resource = VeterinarianScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
