<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pet_id',
        'veterinarian_id',
        'clinic_id',
        'record_type',
        'date',
        'diagnosis',
        'treatment',
        'prescriptions',
        'notes',
        'weight_kg',
        'temperature_celsius',
        'heart_rate',
        'next_appointment',
        'cost',
        'attachments',
        'is_encrypted',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
        'next_appointment' => 'date',
        'weight_kg' => 'decimal:2',
        'temperature_celsius' => 'decimal:2',
        'is_encrypted' => 'boolean',
        'cost' => 'decimal:2',
        'attachments' => 'array',
    ];

    /**
     * Get the pet that owns the medical record.
     */
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    /**
     * Get the veterinarian that created the medical record.
     */
    public function veterinarian()
    {
        return $this->belongsTo(PetcareUser::class, 'veterinarian_id');
    }

    /**
     * Get the clinic where the medical record was created.
     */
    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    /**
     * Get the vaccines associated with this medical record.
     */
    public function vaccines()
    {
        return $this->hasMany(Vaccine::class);
    }
}
