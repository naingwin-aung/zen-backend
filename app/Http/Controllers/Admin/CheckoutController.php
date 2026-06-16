<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ServiceEnum;
use App\Exceptions\MyException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Checkout\Attraction\AttractionProductResource;
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
            $additional = $this->service->getAdditional($checkout);

            $data = $this->resourceProduct($checkout);

            return success([
                'data' => $data,
                'additional' => $additional,
            ], 'Checkout successful.');
        } catch (MyException $e) {
            return custom($e->getMessage());
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    private function resourceProduct(array $results)
    {
        $data = [];
        foreach ($results as $checkout) {
            $data[] = match ($checkout['product']['service']) {
                ServiceEnum::ATTRACTION->value => AttractionProductResource::make($checkout),
                default => null,
            };
        }

        return $data;
    }
}
