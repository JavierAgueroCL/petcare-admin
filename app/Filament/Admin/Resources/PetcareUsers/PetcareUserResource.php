<?php

namespace App\Filament\Admin\Resources\PetcareUsers;

use App\Filament\Admin\Resources\PetcareUsers\Pages\CreatePetcareUser;
use App\Filament\Admin\Resources\PetcareUsers\Pages\EditPetcareUser;
use App\Filament\Admin\Resources\PetcareUsers\Pages\ListPetcareUsers;
use App\Filament\Admin\Resources\PetcareUsers\Schemas\PetcareUserForm;
use App\Filament\Admin\Resources\PetcareUsers\Tables\PetcareUsersTable;
use App\Models\PetcareUser;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PetcareUserResource extends Resource
{
    protected static ?string $model = PetcareUser::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PetcareUserForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PetcareUsersTable::configure($table);
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
            'index' => ListPetcareUsers::route('/'),
            'create' => CreatePetcareUser::route('/create'),
            'edit' => EditPetcareUser::route('/{record}/edit'),
        ];
    }
}
