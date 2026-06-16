<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingAttraction extends Model
{
    public $table = 'booking_attractions';

    protected $fillable = [
        'booking_id',
        'booking_product_id',
        'date',
        'product_snapshot',
        'package_snapshot',
        'quantity_snapshot',
    ];

    protected $casts = [
        'date' => 'date',
        'product_snapshot' => 'json',
        'package_snapshot' => 'json',
        'quantity_snapshot' => 'json',
    ];
}
