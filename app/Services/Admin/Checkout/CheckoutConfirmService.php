<?php

namespace App\Services\Admin\Checkout;

use App\Enums\BookingStatusEnum;
use App\Enums\PaymentStatusEnum;
use App\Enums\ServiceEnum;
use App\Exceptions\MyException;
use App\Models\Booking;
use App\Models\BookingAttraction;
use App\Models\BookingProduct;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;

class CheckoutConfirmService
{
    public function confirm(array $checkout, array $validated)
    {
        try {
            $booking = $this->createBooking($checkout, $validated);
            $this->createBookingProducts($checkout, $booking->id);
            return $booking;
        } catch (MyException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    protected function createBooking(array $checkout, array $validated)
    {
        $totalPrice = $this->totalPrice($checkout);
        $booking = [
            'payment_reference' => Str::uuid(),
            'payment_status' => PaymentStatusEnum::UNPAID->value,
            'sub_total' => $totalPrice,
            'grand_total' => $totalPrice,
            'request_payload' => $validated,
            'created_at' => Carbon::now('UTC'),
            'updated_at' => Carbon::now('UTC'),
        ];

        $booking = Booking::create($booking);
        return $booking;
    }

    protected function createBookingProducts(array $checkout, int $bookingId)
    {
        foreach ($checkout as $product) {
            $bookingProducts = [
                'booking_id' => $bookingId,
                'product_id' => $product['product']['product']['id'],
                'booking_number' => Str::uuid(),
                'booking_status' => BookingStatusEnum::PENDING->value,
                'sub_total' => $product['product']['total_price'],
                'grand_total' => $product['product']['total_price'],
                'created_at' => Carbon::now('UTC'),
                'updated_at' => Carbon::now('UTC'),
            ];
            $bookingProduct = BookingProduct::create($bookingProducts);

            match ($product['product']['service']) {
                ServiceEnum::ATTRACTION->value => $this->createAttractionBooking($bookingProduct, $product['product']),
            };
        }
    }

    protected function createAttractionBooking(BookingProduct $bookingProduct, array $product)
    {
        $attraction = [
            'booking_id' => $bookingProduct->booking_id,
            'booking_product_id' => $bookingProduct->id,
            'date' => $product['date'],
            'product_snapshot' => $product['product'],
            'package_snapshot' => $product['package'],
            'quantity_snapshot' => $product['prices']
        ];
        BookingAttraction::create($attraction);
    }


    protected function totalPrice(array $checkout)
    {
        return collect($checkout)->sum(function ($product) {
            return $product['product']['total_price'];
        });
    }
}
