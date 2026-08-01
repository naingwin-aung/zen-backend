<?php

namespace App\Models;

use App\Services\ReferenceCodeGenerator;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $fillable = [
        'payment_reference',
        'payment_status',
        'sub_total',
        'grand_total',
        'buyer_info',
        'request_payload',
    ];

    protected $casts = [
        'buyer_info' => 'json',
        'request_payload' => 'json',
        'sub_total' => 'float',
        'grand_total' => 'float',
    ];

    protected static function booted(): void
    {
        static::created(function (Booking $booking) {
            if (empty($booking->payment_reference)) {
                $booking->payment_reference = ReferenceCodeGenerator::generate($booking->id, 'PAY');
                $booking->saveQuietly();
            }
        });
    }

    public function bookingProducts()
    {
        return $this->hasMany(BookingProduct::class);
    }
}
