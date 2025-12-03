<?php

namespace App\Filament\Admin\Resources\Appointments;

use App\Filament\Admin\Resources\Appointments\Pages\AppointmentCalendar;
use App\Filament\Admin\Resources\Appointments\Pages\CreateAppointment;
use App\Filament\Admin\Resources\Appointments\Pages\EditAppointment;
use App\Filament\Admin\Resources\Appointments\Pages\ListAppointments;
use App\Filament\Admin\Resources\Appointments\Schemas\AppointmentForm;
use App\Filament\Admin\Resources\Appointments\Tables\AppointmentsTable;
use App\Models\Appointment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $modelLabel = 'Cita';

    protected static ?string $pluralModelLabel = 'Citas';

    protected static ?string $navigationLabel = 'Citas';

    protected static string|\UnitEnum|null $navigationGroup = 'Gestión de Citas';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return AppointmentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AppointmentsTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // Si el usuario es veterinaria, solo mostrar sus propias citas
        $user = auth()->user();
        if ($user && $user->hasRole('veterinaria')) {
            $query->where('veterinarian_id', $user->id);
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
            'index' => ListAppointments::route('/'),
            'create' => CreateAppointment::route('/create'),
            'edit' => EditAppointment::route('/{record}/edit'),
            'calendar' => AppointmentCalendar::route('/calendar'),
        ];
    }
}
