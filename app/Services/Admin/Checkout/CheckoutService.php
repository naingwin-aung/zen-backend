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
            $products = $this->getProducts($validated);

            return $products;
        } catch (MyException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
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

    public function getProducts(array $validated)
    {
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
    }
}
