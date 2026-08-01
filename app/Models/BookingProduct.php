<?php

namespace App\Models;

use App\Services\ReferenceCodeGenerator;
use Illuminate\Database\Eloquent\Model;

class BookingProduct extends Model
{
    protected $table = 'booking_products';

    protected $fillable = [
        'booking_id',
        'product_id',
        'booking_number',
        'booking_status',
        'sub_total',
        'grand_total',
    ];

    protected $casts = [
        'sub_total' => 'float',
        'grand_total' => 'float',
    ];

    protected static function booted(): void
    {
        static::created(function (BookingProduct $bookingProduct) {
            if (empty($bookingProduct->booking_number)) {
                $bookingProduct->booking_number = ReferenceCodeGenerator::generate($bookingProduct->id, 'BOK');
                $bookingProduct->saveQuietly();
            }
        });
    }

    public function bookingAttraction()
    {
        return $this->hasOne(BookingAttraction::class);
    }
}
