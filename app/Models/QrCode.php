<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pet_id',
        'qr_code',
        'qr_image_url',
        'total_scans',
        'last_scanned_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'last_scanned_at' => 'datetime',
    ];

    /**
     * Get the pet that owns the QR code.
     */
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
}
