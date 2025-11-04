<?php

namespace App\Filament\Admin\Resources\Vaccines;

use App\Filament\Admin\Resources\Vaccines\Pages\CreateVaccine;
use App\Filament\Admin\Resources\Vaccines\Pages\EditVaccine;
use App\Filament\Admin\Resources\Vaccines\Pages\ListVaccines;
use App\Filament\Admin\Resources\Vaccines\Schemas\VaccineForm;
use App\Filament\Admin\Resources\Vaccines\Tables\VaccinesTable;
use App\Models\Vaccine;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class VaccineResource extends Resource
{
    protected static ?string $model = Vaccine::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return VaccineForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VaccinesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVaccines::route('/'),
            'create' => CreateVaccine::route('/create'),
            'edit' => EditVaccine::route('/{record}/edit'),
        ];
    }
}
