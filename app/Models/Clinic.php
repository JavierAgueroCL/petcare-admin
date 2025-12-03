<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Clinic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'commune',
        'region',
        'phone',
        'email',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Veterinarios que trabajan en esta clínica
     */
    public function veterinarians(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'clinic_user');
    }

    /**
     * Horarios de la clínica
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(VeterinarianSchedule::class);
    }
}
