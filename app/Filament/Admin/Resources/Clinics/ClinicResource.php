<?php

namespace App\Filament\Admin\Resources\Clinics;

use App\Filament\Admin\Resources\Clinics\Pages\CreateClinic;
use App\Filament\Admin\Resources\Clinics\Pages\EditClinic;
use App\Filament\Admin\Resources\Clinics\Pages\ListClinics;
use App\Filament\Admin\Resources\Clinics\Schemas\ClinicForm;
use App\Filament\Admin\Resources\Clinics\Tables\ClinicsTable;
use App\Models\Clinic;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ClinicResource extends Resource
{
    protected static ?string $model = Clinic::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $modelLabel = 'Clínica';

    protected static ?string $pluralModelLabel = 'Clínicas';

    protected static ?string $navigationLabel = 'Clínicas';

    protected static string|\UnitEnum|null $navigationGroup = 'Administración';

    protected static ?int $navigationSort = 305;

    public static function form(Schema $schema): Schema
    {
        return ClinicForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ClinicsTable::configure($table);
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
            'index' => ListClinics::route('/'),
            'create' => CreateClinic::route('/create'),
            'edit' => EditClinic::route('/{record}/edit'),
        ];
    }
}
