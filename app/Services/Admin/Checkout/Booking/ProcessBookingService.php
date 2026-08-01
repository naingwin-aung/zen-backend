<?php

namespace App\Services\Admin\Checkout\Booking;

use App\Enums\BookingStatusEnum;
use App\Enums\PaymentStatusEnum;
use App\Enums\ServiceEnum;
use App\Models\Booking;
use App\Models\BookingAttraction;
use App\Models\BookingProduct;
use App\Services\ReferenceCodeGenerator;
use Carbon\Carbon;

class ProcessBookingService
{
    public function __construct(public array $checkout, public array $requestValidated)
    {
        //
    }

    public function createBooking()
    {
        $totalPrice = $this->getTotalPrice();

        $booking = Booking::create([
            'payment_status' => PaymentStatusEnum::UNPAID->value,
            'sub_total' => $totalPrice,
            'grand_total' => $totalPrice,
            'buyer_info' => $this->requestValidated['buyer'],
            'request_payload' => $this->requestValidated,
            'created_at' => Carbon::now('UTC'),
            'updated_at' => Carbon::now('UTC'),
        ]);

        $booking->update([
            'payment_reference' => ReferenceCodeGenerator::generate($booking->id, 'PAY'),
        ]);

        return $booking;
    }

    public function createBookingProducts(int $bookingId)
    {
        foreach ($this->checkout as $product) {
            $bookingProduct = BookingProduct::create([
                'booking_id' => $bookingId,
                'product_id' => $product['product']['product']['id'],
                'booking_status' => BookingStatusEnum::PENDING->value,
                'sub_total' => $product['product']['total_price'],
                'grand_total' => $product['product']['total_price'],
                'created_at' => Carbon::now('UTC'),
                'updated_at' => Carbon::now('UTC'),
            ]);

            $bookingProduct->update([
                'booking_number' => ReferenceCodeGenerator::generate($bookingProduct->id, 'BOK'),
            ]);

            match ($product['product']['service']) {
                ServiceEnum::ATTRACTION->value => $this->createAttractionBooking($bookingProduct, $product['product']),
            };
        }
    }

    public function createAttractionBooking(BookingProduct $bookingProduct, array $product)
    {
        $attraction = [
            'booking_id' => $bookingProduct->booking_id,
            'booking_product_id' => $bookingProduct->id,
            'date' => $product['date'],
            'product_snapshot' => $product['product'],
            'package_snapshot' => $product['package'],
            'quantity_snapshot' => $product['prices'],
        ];

        BookingAttraction::create($attraction);
    }

    public function getTotalPrice()
    {
        return collect($this->checkout)->sum(function ($product) {
            return $product['product']['total_price'];
        });
    }
}
