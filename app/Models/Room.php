<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    protected $fillable = [
        'room_number',
        'room_class',
        'bed_type',
        'max_occupancy',
        'price_per_night',
        'status',
        'view_type',
    ];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}