<?php

namespace App\Filament\Admin\Resources\LegalContents\Pages;

use App\Filament\Admin\Resources\LegalContents\LegalContentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLegalContents extends ListRecords
{
    protected static string $resource = LegalContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
