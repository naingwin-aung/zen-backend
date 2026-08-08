<?php

namespace App\Http\Resources\Admin\Booking\Attraction;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingAttractionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request) : array
    {
        $product = $this->product_snapshot ?? [];
        $package = $this->package_snapshot ?? [];
        $prices = $this->quantity_snapshot ?? [];

        return [
            'id' => $this->id,
            'date' => $this->date?->toDateString(),
            'product' => [
                'id' => data_get($product, 'id'),
                'name' => data_get($product, 'name'),
                'slug' => data_get($product, 'slug'),
                'service' => data_get($product, 'service'),
                'star_rating' => data_get($product, 'star_rating'),
                'price' => data_get($product, 'price'),
                'images' => collect(data_get($product, 'images', []))->map(fn($image) => [
                    'id' => data_get($image, 'id'),
                    'url' => data_get($image, 'url'),
                ]),
            ],
            'package' => [
                'id' => data_get($package, 'id'),
                'name' => data_get($package, 'name'),
                'description' => data_get($package, 'description'),
            ],
            'prices' => collect($prices)->map(function ($price) {
                $ageGroup = data_get($price, 'age_group') ?? data_get($price, 'ageGroup');

                return [
                    'id' => data_get($price, 'id'),
                    'name' => data_get($ageGroup, 'name'),
                    'min_age' => data_get($ageGroup, 'min_age'),
                    'max_age' => data_get($ageGroup, 'max_age'),
                    'price' => data_get($price, 'price'),
                    'quantity' => data_get($price, 'quantity'),
                    'total' => data_get($price, 'total'),
                ];
            }),
        ];
    }
}
