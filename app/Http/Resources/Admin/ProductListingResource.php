<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request) : array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'slug'        => $this->slug,
            'service'     => $this->service,
            'star_rating' => $this->star_rating,
            'price'       => $this->price,
            'categories'  => $this->categories->map(fn($category) => [
                'id'   => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
            ]),
            'images'      => $this->images->map(fn($image) => [
                'id'  => $image->id,
                'url' => $image->url,
            ]),
            'countries'   => $this->countries->map(fn($country) => [
                'id'        => $country->id,
                'name'      => $country->name,
                'slug'      => $country->slug,
                'dial_code' => $country->dial_code,
            ]),
            'cities'      => $this->cities->map(fn($city) => [
                'id'   => $city->id,
                'name' => $city->name,
                'slug' => $city->slug,
            ]),
        ];
    }
}
