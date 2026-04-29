<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingProduct extends Model
{
    protected $table = 'booking_products';
    protected $fillable = [
        'booking_id',
        'productable_id',
        'productable_type',
        'payment_status',
        'booking_status',
        'sub_total',
        'grand_total',
    ];
}
