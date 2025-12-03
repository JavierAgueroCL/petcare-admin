<?php

namespace App\Filament\Admin\Resources\Vaccines;

use App\Filament\Admin\Resources\Vaccines\Pages\CreateVaccine;
use App\Filament\Admin\Resources\Vaccines\Pages\EditVaccine;
use App\Filament\Admin\Resources\Vaccines\Pages\ListVaccines;
use App\Filament\Admin\Resources\Vaccines\Schemas\VaccineForm;
use App\Filament\Admin\Resources\Vaccines\Tables\VaccinesTable;
use App\Models\Appointment;
use App\Models\Vaccine;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class VaccineResource extends Resource
{
    protected static ?string $model = Vaccine::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $modelLabel = 'Vacuna';

    protected static ?string $pluralModelLabel = 'Vacunas';

    protected static ?string $navigationLabel = 'Vacunas';

    protected static string|\UnitEnum|null $navigationGroup = 'Servicios Veterinarios';

    protected static ?int $navigationSort = 101;

    public static function form(Schema $schema): Schema
    {
        return VaccineForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VaccinesTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // Si el usuario es veterinaria, solo mostrar vacunas de mascotas que atiende
        $user = auth()->user();
        if ($user && $user->hasRole('veterinaria')) {
            $petIds = Appointment::where('veterinarian_id', $user->id)
                ->distinct()
                ->pluck('pet_id');

            $query->whereIn('pet_id', $petIds);
        }

        return $query;
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
