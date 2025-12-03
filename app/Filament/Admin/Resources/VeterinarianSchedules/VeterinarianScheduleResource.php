<?php

namespace App\Filament\Admin\Resources\VeterinarianSchedules;

use App\Filament\Admin\Resources\VeterinarianSchedules\Pages\CreateVeterinarianSchedule;
use App\Filament\Admin\Resources\VeterinarianSchedules\Pages\EditVeterinarianSchedule;
use App\Filament\Admin\Resources\VeterinarianSchedules\Pages\ListVeterinarianSchedules;
use App\Filament\Admin\Resources\VeterinarianSchedules\Schemas\VeterinarianScheduleForm;
use App\Filament\Admin\Resources\VeterinarianSchedules\Tables\VeterinarianSchedulesTable;
use App\Models\VeterinarianSchedule;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class VeterinarianScheduleResource extends Resource
{
    protected static ?string $model = VeterinarianSchedule::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationLabel = 'Horarios Veterinarios';

    protected static ?string $modelLabel = 'Horario Veterinario';

    protected static ?string $pluralModelLabel = 'Horarios Veterinarios';

    protected static string|\UnitEnum|null $navigationGroup = 'Administración';

    protected static ?int $navigationSort = 300;

    public static function form(Schema $schema): Schema
    {
        return VeterinarianScheduleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VeterinarianSchedulesTable::configure($table);
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
            'index' => ListVeterinarianSchedules::route('/'),
            'create' => CreateVeterinarianSchedule::route('/create'),
            'edit' => EditVeterinarianSchedule::route('/{record}/edit'),
        ];
    }
}
