<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'pet_id',
        'veterinarian_id',
        'appointment_type',
        'appointment_datetime',
        'status',
        'clinic_name',
        'veterinarian_name',
        'notes',
        'cost',
        'reminder_sent',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'appointment_datetime' => 'datetime',
        'reminder_sent' => 'boolean',
        'cost' => 'decimal:2',
    ];

    /**
     * Get the user that owns the appointment.
     */
    public function user()
    {
        return $this->belongsTo(PetcareUser::class);
    }

    /**
     * Get the pet that the appointment is for.
     */
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    /**
     * Get the veterinarian that will attend the appointment.
     */
    public function veterinarian()
    {
        return $this->belongsTo(User::class, 'veterinarian_id');
    }

    /**
     * Métodos para el calendario de citas
     */
    public function getEventStart(): ?\Carbon\Carbon
    {
        return $this->appointment_datetime;
    }

    public function getEventEnd(): ?\Carbon\Carbon
    {
        // Asumimos 30 minutos de duración si no hay veterinario asignado
        $duration = 30;

        if ($this->veterinarian_id) {
            $dayOfWeek = $this->appointment_datetime->dayOfWeek;
            $schedule = VeterinarianSchedule::where('user_id', $this->veterinarian_id)
                ->where('day_of_week', $dayOfWeek)
                ->where('is_active', true)
                ->first();

            if ($schedule) {
                $duration = $schedule->consultation_duration;
            }
        }

        return $this->appointment_datetime?->addMinutes($duration);
    }

    public function getEventTitle(): ?string
    {
        $petName = $this->pet?->name ?? 'Sin mascota';
        $type = match($this->appointment_type) {
            'checkup' => 'Revisión',
            'vaccine' => 'Vacuna',
            'grooming' => 'Peluquería',
            'emergency' => 'Emergencia',
            'surgery' => 'Cirugía',
            default => 'Consulta',
        };

        return "{$type} - {$petName}";
    }

    public function getEventColor(): ?string
    {
        return match($this->status) {
            'scheduled' => '#fbbf24', // amber
            'confirmed' => '#3b82f6', // blue
            'completed' => '#10b981', // green
            'cancelled' => '#ef4444', // red
            default => '#6b7280', // gray
        };
    }
}
