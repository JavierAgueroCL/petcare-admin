<?php

namespace App\Filament\Admin\Resources\LegalContents\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LegalContentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')
                    ->options(['terms' => 'Terms', 'privacy' => 'Privacy'])
                    ->required(),
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('version')
                    ->required()
                    ->default('1.0.0'),
                Toggle::make('is_active'),
                DatePicker::make('effective_date'),
            ]);
    }
}
