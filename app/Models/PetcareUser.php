<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetcareUser extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'email',
        'password',
        'phone',
        'first_name',
        'last_name',
        'rut',
        'date_of_birth',
        'profile_image_url',
        'address',
        'commune',
        'region',
        'role',
        'is_active',
        'email_verified',
        'phone_verified',
        'last_login',
        'language',
        'notification_settings',
        'preferences',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'is_active' => 'boolean',
        'email_verified' => 'boolean',
        'phone_verified' => 'boolean',
        'last_login' => 'datetime',
        'notification_settings' => 'array',
        'preferences' => 'array',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Get the pets owned by the user.
     */
    public function pets()
    {
        return $this->hasMany(Pet::class, 'owner_id');
    }

    /**
     * Get the appointments for the user.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'user_id');
    }

    /**
     * Get the user's full name.
     */
    public function getNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }
}
