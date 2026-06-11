<?php

namespace App\Services\Admin\Checkout;

use App\Enums\ServiceEnum;
use App\Exceptions\MyException;
use App\Services\Admin\Checkout\Attraction\AttractionCheckoutService;
use Exception;

class CheckoutService
{
    public function checkout(array $validated)
    {
        try {
            $products = [];
            foreach ($validated['products'] as $product) {
                switch ($product['service']) {
                    case ServiceEnum::ATTRACTION->value:
                        $products[] = (new AttractionCheckoutService)->handle($product);
                        break;
                    default:
                        break;
                }
            }

            return $products;
        } catch (MyException $e) {
            throw new MyException($e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getAdditional(array $products)
    {
        $totalPrice = collect($products)->sum('total_price');

        return [
            'total_price' => $totalPrice,
        ];
    }
}
