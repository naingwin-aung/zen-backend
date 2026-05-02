<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $fillable = [
        'booking_reference',
        'payment_status',
        'sub_total',
        'grand_total',
        'user_id',
        'request_payload',
    ];
}
