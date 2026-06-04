<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\Checkout\CheckoutValidationService;
use Exception;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index(Request $request)
    {
        [$rules, $messages] = (new CheckoutValidationService)->validate($request);
        $request->validate($rules, $messages);

        try {
            return success([], 'Checkout successful.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }
}
