<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $fillable = [
        'payment_reference',
        'payment_status',
        'sub_total',
        'grand_total',
        'user_id',
        'request_payload',
    ];

    protected $casts = [
        'request_payload' => 'json',
        'sub_total'       => 'float',
        'grand_total'     => 'float',
    ];
}
