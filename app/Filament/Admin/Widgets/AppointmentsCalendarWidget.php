<?php

namespace App\Filament\Admin\Widgets;

use App\Filament\Admin\Resources\Appointments\AppointmentResource;
use App\Models\Appointment;
use Saade\FilamentFullCalendar\Data\EventData;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class AppointmentsCalendarWidget extends FullCalendarWidget
{
    public function fetchEvents(array $fetchInfo): array
    {
        $query = Appointment::query()
            ->with(['pet', 'veterinarian'])
            ->whereBetween('appointment_datetime', [
                $fetchInfo['start'],
                $fetchInfo['end'],
            ]);

        // Si el usuario es veterinario, mostrar solo sus citas
        if (auth()->user()->hasRole('veterinaria')) {
            $query->where('veterinarian_id', auth()->id());
        }

        return $query->get()
            ->map(function (Appointment $appointment) {
                $start = $appointment->getEventStart();
                $end = $appointment->getEventEnd();

                return EventData::make()
                    ->id($appointment->id)
                    ->title($appointment->getEventTitle())
                    ->start($start)
                    ->end($end)
                    ->allDay(false)
                    ->backgroundColor($appointment->getEventColor())
                    ->url(
                        AppointmentResource::getUrl('edit', ['record' => $appointment->id]),
                        shouldOpenUrlInNewTab: false
                    )
                    ->toArray();
            })
            ->toArray();
    }

    public function config(): array
    {
        return [
            'locale' => 'es',
            'initialView' => 'timeGridWeek',
            'headerToolbar' => [
                'left' => 'prev,next today',
                'center' => 'title',
                'right' => 'dayGridMonth,timeGridWeek,timeGridDay',
            ],
            'buttonText' => [
                'today' => 'Hoy',
                'month' => 'Mes',
                'week' => 'Semana',
                'day' => 'Día',
            ],
            'slotMinTime' => '06:00:00',
            'slotMaxTime' => '23:59:00',
            'slotDuration' => '00:15:00',
            'slotLabelInterval' => '01:00:00',
            'allDaySlot' => false,
            'nowIndicator' => true,
            'navLinks' => true,
            'editable' => false,
            'eventDisplay' => 'block',
            'height' => 'auto',
            'contentHeight' => 650,
            'expandRows' => true,
        ];
    }

    public static function canView(): bool
    {
        // Solo mostrar el widget en las páginas de calendario, no en el Dashboard automático
        return false;
    }
}
