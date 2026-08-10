<?php

namespace App\Http\Resources\Admin\Checkout\Attraction;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttractionProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $attraction = $this['product']['product'];
        $package = $this['product']['package'];
        $prices = $this['product']['prices'];

        return [
            'id' => $attraction['id'],
            'name' => $attraction['name'],
            'slug' => $attraction['slug'],
            'service' => $attraction['service'],
            'star_rating' => $attraction['star_rating'],
            'price' => $attraction['price'],
            'categories' => $attraction['categories']->map(fn ($category) => [
                'id' => $category['id'],
                'name' => $category['name'],
                'slug' => $category['slug'],
            ]),
            'images' => $attraction['images']->map(fn ($image) => [
                'id' => $image['id'],
                'url' => $image['url'],
            ]),
            'countries' => $attraction['countries']->map(fn ($country) => [
                'id' => $country['id'],
                'name' => $country['name'],
                'slug' => $country['slug'],
                'dial_code' => $country['dial_code'],
            ]),
            'cities' => $attraction['cities']->map(fn ($city) => [
                'id' => $city['id'],
                'name' => $city['name'],
                'slug' => $city['slug'],
            ]),
            'package' => [
                'id' => $package['id'],
                'name' => $package['name'],
                'description' => $package['description'],
            ],
            'prices' => $prices->map(fn ($price) => [
                'id' => $price['id'],
                'name' => $price['ageGroup']['name'],
                'min_age' => $price['ageGroup']['min_age'],
                'max_age' => $price['ageGroup']['max_age'],
                'price' => $price['price'],
                'quantity' => $price['quantity'],
                'total' => $price['total'],
            ]),
            'total_price' => $this['product']['total_price'],
            'date' => $this['product']['date'],
        ];
    }
}
