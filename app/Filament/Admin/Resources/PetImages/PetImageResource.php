<?php

namespace App\Filament\Admin\Resources\PetImages;

use App\Filament\Admin\Resources\PetImages\Pages\CreatePetImage;
use App\Filament\Admin\Resources\PetImages\Pages\EditPetImage;
use App\Filament\Admin\Resources\PetImages\Pages\ListPetImages;
use App\Filament\Admin\Resources\PetImages\Schemas\PetImageForm;
use App\Filament\Admin\Resources\PetImages\Tables\PetImagesTable;
use App\Models\PetImage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PetImageResource extends Resource
{
    protected static ?string $model = PetImage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PetImageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PetImagesTable::configure($table);
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
            'index' => ListPetImages::route('/'),
            'create' => CreatePetImage::route('/create'),
            'edit' => EditPetImage::route('/{record}/edit'),
        ];
    }
}
