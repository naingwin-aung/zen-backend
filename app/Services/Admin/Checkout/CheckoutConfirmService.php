<?php

namespace App\Services\Admin\Checkout;

use App\Exceptions\MyException;
use App\Services\Admin\Checkout\Booking\ProcessBookingService;
use Exception;

class CheckoutConfirmService
{
    public function confirm(array $checkout, array $validated)
    {
        try {
            $service = (new ProcessBookingService($checkout, $validated));
            $booking = $service->createBooking();
            $service->createBookingProducts($booking->id);

            return $booking;
        } catch (MyException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
