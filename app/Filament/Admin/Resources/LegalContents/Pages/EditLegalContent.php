<?php

namespace App\Filament\Admin\Resources\LegalContents\Pages;

use App\Filament\Admin\Resources\LegalContents\LegalContentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLegalContent extends EditRecord
{
    protected static string $resource = LegalContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
