<?php

namespace App\Filament\Admin\Resources\LegalContents\Pages;

use App\Filament\Admin\Resources\LegalContents\LegalContentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLegalContent extends CreateRecord
{
    protected static string $resource = LegalContentResource::class;
}
