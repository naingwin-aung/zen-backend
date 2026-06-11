<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\MyException;
use App\Http\Controllers\Controller;
use App\Services\Admin\Checkout\CheckoutService;
use App\Services\Admin\Checkout\CheckoutValidationService;
use Exception;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct(public CheckoutService $service)
    {
        //
    }

    public function index(Request $request)
    {
        [$rules, $messages] = (new CheckoutValidationService)->validate($request);
        $validated = $request->validate($rules, $messages);

        try {
            $checkout = $this->service->checkout($validated);
            $pricing = $this->service->getAdditional($checkout);

            return success([
                'checkout' => $checkout,
                'pricing' => $pricing,
            ], 'Checkout successful.');
        } catch (MyException $e) {
            return custom($e->getMessage());
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }
}
