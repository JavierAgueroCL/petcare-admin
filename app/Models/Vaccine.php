<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pet_id',
        'medical_record_id',
        'vaccine_name',
        'vaccine_type',
        'manufacturer',
        'batch_number',
        'administration_date',
        'next_dose_date',
        'veterinarian_id',
        'clinic_id',
        'certificate_url',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'administration_date' => 'date',
        'next_dose_date' => 'date',
    ];

    /**
     * Get the pet that received the vaccine.
     */
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    /**
     * Get the medical record associated with this vaccine.
     */
    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class);
    }
}
