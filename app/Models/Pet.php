<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'breed',
        'gender',
        'date_of_birth',
        'estimated_age_months',
        'color',
        'size',
        'weight_kg',
        'microchip_number',
        'national_registry_number',
        'profile_image_url',
        'qr_code',
        'is_sterilized',
        'sterilization_date',
        'special_needs',
        'temperament',
        'status',
        'lost_date',
        'lost_location',
        'is_public',
        'species',
        'owner_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'date',
        'sterilization_date' => 'date',
        'lost_date' => 'datetime',
        'is_sterilized' => 'boolean',
        'is_public' => 'boolean',
        'weight_kg' => 'decimal:2',
    ];

    /**
     * Get the owner of the pet.
     */
    public function owner()
    {
        return $this->belongsTo(PetcareUser::class, 'owner_id');
    }

    /**
     * Get the appointments for the pet.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Get the medical records for the pet.
     */
    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    /**
     * Get the vaccines for the pet.
     */
    public function vaccines()
    {
        return $this->hasMany(Vaccine::class);
    }

    /**
     * Get the QR code for the pet.
     */
    public function qrCode()
    {
        return $this->hasOne(QrCode::class);
    }

    /**
     * Get the images for the pet.
     */
    public function images()
    {
        return $this->hasMany(PetImage::class);
    }
}
