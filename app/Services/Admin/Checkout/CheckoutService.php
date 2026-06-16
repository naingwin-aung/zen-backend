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
            foreach ($validated['products'] as $key => $product) {
                switch ($product['service']) {
                    case ServiceEnum::ATTRACTION->value:
                        $products[$key]['product'] = (new AttractionCheckoutService)->handle($product);
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
        $totalPrice = collect($products)->sum(function ($product) {
            return $product['product']['total_price'];
        });

        return [
            'total_price' => $totalPrice,
        ];
    }
}
