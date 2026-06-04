<?php

namespace App\Services\Admin\Checkout;

use App\Enums\ServiceEnum;
use App\Services\Admin\Checkout\Attraction\AttractionValidateService;
use Illuminate\Http\Request;

class CheckoutValidationService
{
    /**
     * Validate the checkout request.
     *
     * @return array{0: array<string, string>, 1: array<string, string>}
     */
    public function validate(Request $request) : array
    {
        $rules = [
            'products' => 'required|array',
            'products.*.service' => 'required|in:' . implode(',', array_column(ServiceEnum::cases(), 'value')),
        ];

        $messages = [
            'products.required' => 'Products is required.',
            'products.array' => 'Products must be an array.',
            'products.*.service.required' => 'Service is required.',
            'products.*.service.in' => 'Service is invalid.',
        ];

        if ($request->has('products') && is_array($request->products)) {
            foreach ($request->products as $key => $product) {
                if (!isset($product['service'])) {
                    continue;
                }

                switch ($product['service']) {
                    case ServiceEnum::ATTRACTION->value:
                        (new AttractionValidateService)->rules($key, $rules);
                        (new AttractionValidateService)->messages($key, $messages);
                        break;
                    default:
                        break;
                }
            }
        }

        return [$rules, $messages];
    }
}
