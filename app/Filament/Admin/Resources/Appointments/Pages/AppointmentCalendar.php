<?php

namespace App\Filament\Admin\Resources\Appointments\Pages;

use App\Filament\Admin\Resources\Appointments\AppointmentResource;
use App\Filament\Admin\Widgets\AppointmentsCalendarWidget;
use BackedEnum;
use Filament\Resources\Pages\Page;

class AppointmentCalendar extends Page
{
    protected static string $resource = AppointmentResource::class;

    protected string $view = 'filament.admin.resources.appointments.pages.appointment-calendar';

    protected static ?string $navigationLabel = 'Calendario';

    protected static ?string $title = 'Calendario de Citas';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-calendar-days';

    protected static string|\UnitEnum|null $navigationGroup = 'Gestión de Citas';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?int $navigationSort = 1;

    public function getHeaderWidgets(): array
    {
        return [
            AppointmentsCalendarWidget::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int | array
    {
        return 1;
    }
}
