<?php

namespace App\Services\Admin\Checkout\Attraction;

use App\Enums\ClosingTypeEnum;
use App\Enums\ServiceEnum;
use App\Models\AttractionPackage;
use App\Models\AttractionPrice;
use App\Models\Product;
use Carbon\Carbon;
use Exception;

class AttractionCheckoutService
{
    public function handle(array $requestProduct)
    {
        $product = Product::with(['schedule', 'images'])
            ->where('id', $requestProduct['product_id'])->first();

        if (! $product) {
            throw new Exception('Product Not Found');
        }

        // check closing date
        $schedule = $product->schedule;
        $startDate = Carbon::parse($schedule->start_date);
        $endDate = Carbon::parse($schedule->end_date);
        $currentDate = Carbon::parse($requestProduct['date']);

        if ($currentDate->lt($startDate) || $currentDate->gt($endDate)) {
            throw new Exception('Date is out of range');
        }

        if ($schedule->closing_type == ClosingTypeEnum::CLOSING_DATES->value) {
            $closingDates = $schedule->closing_dates ?? [];
            if (in_array($currentDate->toDateString(), $closingDates)) {
                throw new Exception('Date is closed');
            }
        } elseif ($schedule->closing_type == ClosingTypeEnum::CLOSING_DAYS->value) {
            $closingDays = generateDatesFromClosingDays($schedule->closing_days, $schedule->start_date, $schedule->end_date);
            if (in_array($currentDate->toDateString(), $closingDays)) {
                throw new Exception('Date is closed');
            }
        }

        // check package
        $package = AttractionPackage::where('product_id', $product->id)
            ->where('id', $requestProduct['package_id'])
            ->first();

        if (! $package) {
            throw new Exception('Package Not Found');
        }

        // check quantities
        $requestQuantities = collect($requestProduct['quantities'])->keyBy('id');

        $prices = AttractionPrice::with('ageGroup')
            ->whereIn('id', $requestQuantities->keys())
            ->get();

        if ($prices->isEmpty()) {
            throw new Exception('Price Not Found');
        }

        $prices = $prices->map(function ($price) use ($requestQuantities) {
            $quantity = data_get($requestQuantities[$price->id], 'quantity', 0);
            $price['quantity'] = $quantity;
            $price['total'] = $quantity * $price->price;

            return $price;
        });

        $totalPrice = $prices->sum('total');

        return [
            'service' => ServiceEnum::ATTRACTION->value,
            'product' => $product,
            'package' => $package,
            'prices' => $prices,
            'total_price' => $totalPrice,
            'date' => $currentDate->toDateString(),
        ];
    }
}
