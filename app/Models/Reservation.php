<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    protected $fillable = [
        'booking_reference',
        'user_id',
        'room_id',
        'check_in',
        'check_out',
        'total_amount',
        'booking_status',
        'actual_check_in',
        'actual_check_out',
    ];

    protected function casts(): array
    {
        return [
            'check_in' => 'date',
            'check_out' => 'date',
            'actual_check_in' => 'datetime',
            'actual_check_out' => 'datetime',
            'total_amount' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
