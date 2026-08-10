<?php

namespace App\Http\Resources\Admin\Product;

use App\Enums\ServiceEnum;
use App\Http\Resources\Admin\Attraction\AttractionPackageResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $result = [
            'id' => $this->id,
            'name' => method_exists($this->resource, 'getTranslations') ? $this->getTranslations('name') : $this->name,
            'slug' => $this->slug,
            'service' => $this->service,
            'star_rating' => $this->star_rating,
            'price' => $this->price,
            'images' => $this->images->map(fn ($image) => [
                'id' => $image->id,
                'url' => $image->url,
            ]),
            'categories' => $this->categories->map(fn ($category) => [
                'id' => $category->id,
                'name' => method_exists($category, 'getTranslations') ? $category->getTranslations('name') : $category->name,
                'slug' => $category->slug,
            ]),
            'countries' => $this->countries->map(fn ($country) => [
                'id' => $country->id,
                'name' => $country->name,
                'slug' => $country->slug,
                'dial_code' => $country->dial_code,
            ]),
            'cities' => $this->cities->map(fn ($city) => [
                'id' => $city->id,
                'name' => $city->name,
                'slug' => $city->slug,
            ]),
            'what_to_expect' => $this->detail && method_exists($this->detail, 'getTranslations') ? $this->detail->getTranslations('what_to_expect') : $this->detail?->what_to_expect,
            'good_to_know' => $this->detail && method_exists($this->detail, 'getTranslations') ? $this->detail->getTranslations('good_to_know') : $this->detail?->good_to_know,
            'highlights' => $this->detail && method_exists($this->detail, 'getTranslations') ? $this->detail->getTranslations('highlights') : $this->detail?->highlights,
            'schedule' => new ProductScheduleResource($this->whenLoaded('schedule')),
        ];

        switch ($this->service) {
            case ServiceEnum::ATTRACTION->value:
                $result['attraction_packages'] = AttractionPackageResource::collection($this->whenLoaded('attractionPackages'));
                break;
        }

        return $result;
    }
}
