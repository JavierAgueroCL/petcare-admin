<?php

namespace App\Filament\Admin\Pages;

use App\Filament\Admin\Widgets\AppointmentsCalendarWidget;
use BackedEnum;
use Filament\Pages\Page;

class CalendarPage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Calendario';

    protected static ?string $title = 'Calendario de Citas';

    protected static string|\UnitEnum|null $navigationGroup = 'Gestión de Citas';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.admin.pages.calendar-page';

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
