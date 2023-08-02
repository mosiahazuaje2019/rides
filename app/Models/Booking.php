<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'driver_id',
        'pax',
        'service',
        'client_name',
        'hotel',
        'flight',
        'date',
        'time',
        'agency',
        'status',
        'extras'
    ];


    function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id', 'id');
    }

}
