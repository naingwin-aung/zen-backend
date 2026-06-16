<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\MyException;
use App\Http\Controllers\Controller;
use App\Services\Admin\Checkout\CheckoutValidationService;
use Exception;
use Illuminate\Http\Request;

class CheckoutConfirmController extends Controller
{
    public function index(Request $request)
    {
        [$rules, $messages] = (new CheckoutValidationService)->validate($request, true);
        $validated = $request->validate($rules, $messages);

        try {
            dd($validated);
        } catch (MyException $e) {
            return custom($e->getMessage());
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }
}
