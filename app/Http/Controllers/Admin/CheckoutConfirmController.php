<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\MyException;
use App\Http\Controllers\Controller;
use App\Services\Admin\Checkout\CheckoutConfirmService;
use App\Services\Admin\Checkout\CheckoutService;
use App\Services\Admin\Checkout\CheckoutValidationService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutConfirmController extends Controller
{
    public function __construct(public CheckoutConfirmService $service)
    {
        //
    }

    public function index(Request $request)
    {
        [$rules, $messages] = (new CheckoutValidationService)->validate($request, true);
        $validated = $request->validate($rules, $messages);

        DB::beginTransaction();
        try {
            $checkout = (new CheckoutService)->checkout($validated);
            $booking = $this->service->confirm($checkout, $validated);

            DB::commit();

            return success([
                'payment_reference' => $booking->payment_reference,
                'payment_status' => $booking->payment_status,
                'grand_total' => $booking->grand_total,
            ], 'Checkout successful.');
        } catch (MyException $e) {
            DB::rollBack();

            return custom($e->getMessage());
        } catch (Exception $e) {
            DB::rollBack();

            return error($e->getMessage());
        }
    }
}
