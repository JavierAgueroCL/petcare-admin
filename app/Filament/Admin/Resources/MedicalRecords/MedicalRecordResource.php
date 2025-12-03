<?php

namespace App\Filament\Admin\Resources\MedicalRecords;

use App\Filament\Admin\Resources\MedicalRecords\Pages\CreateMedicalRecord;
use App\Filament\Admin\Resources\MedicalRecords\Pages\EditMedicalRecord;
use App\Filament\Admin\Resources\MedicalRecords\Pages\ListMedicalRecords;
use App\Filament\Admin\Resources\MedicalRecords\Schemas\MedicalRecordForm;
use App\Filament\Admin\Resources\MedicalRecords\Tables\MedicalRecordsTable;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MedicalRecordResource extends Resource
{
    protected static ?string $model = MedicalRecord::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $modelLabel = 'Registro Médico';

    protected static ?string $pluralModelLabel = 'Registros Médicos';

    protected static ?string $navigationLabel = 'Registros Médicos';

    protected static string|\UnitEnum|null $navigationGroup = 'Servicios Veterinarios';

    protected static ?int $navigationSort = 100;

    public static function form(Schema $schema): Schema
    {
        return MedicalRecordForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MedicalRecordsTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // Si el usuario es veterinaria, solo mostrar registros de mascotas que atiende
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
            'index' => ListMedicalRecords::route('/'),
            'create' => CreateMedicalRecord::route('/create'),
            'edit' => EditMedicalRecord::route('/{record}/edit'),
        ];
    }
}
