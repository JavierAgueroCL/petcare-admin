<?php

namespace App\Filament\Admin\Resources\Pets;

use App\Filament\Admin\Resources\Pets\Pages\CreatePet;
use App\Filament\Admin\Resources\Pets\Pages\EditPet;
use App\Filament\Admin\Resources\Pets\Pages\ListPets;
use App\Filament\Admin\Resources\Pets\Schemas\PetForm;
use App\Filament\Admin\Resources\Pets\Tables\PetsTable;
use App\Models\Appointment;
use App\Models\Pet;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PetResource extends Resource
{
    protected static ?string $model = Pet::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $modelLabel = 'Mascota';

    protected static ?string $pluralModelLabel = 'Mascotas';

    protected static ?string $navigationLabel = 'Mascotas';

    protected static string|\UnitEnum|null $navigationGroup = 'Gestión de Mascotas';

    protected static ?int $navigationSort = 201;

    public static function form(Schema $schema): Schema
    {
        return PetForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PetsTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // Si el usuario es veterinaria, solo mostrar mascotas que atiende
        $user = auth()->user();
        if ($user && $user->hasRole('veterinaria')) {
            $petIds = Appointment::where('veterinarian_id', $user->id)
                ->distinct()
                ->pluck('pet_id');

            $query->whereIn('id', $petIds);
        }

        return $query;
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\AppointmentsRelationManager::class,
            RelationManagers\MedicalRecordsRelationManager::class,
            RelationManagers\VaccinesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPets::route('/'),
            'create' => CreatePet::route('/create'),
            'edit' => EditPet::route('/{record}/edit'),
        ];
    }
}
