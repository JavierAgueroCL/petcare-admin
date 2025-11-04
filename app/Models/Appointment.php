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
}
