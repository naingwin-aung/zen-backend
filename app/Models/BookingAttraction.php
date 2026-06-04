<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingAttraction extends Model
{
    public $table = 'booking_attractions';

    protected $fillable = [
        'booking_id',
        'booking_product_id',
        'attraction_id',
        'product_snapshot',
        'option_snapshot',
    ];

    protected $casts = [
        'product_snapshot' => 'json',
        'option_snapshot' => 'json',
    ];
}
