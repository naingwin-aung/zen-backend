<?php

namespace App\Http\Resources\Admin\Attraction;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttractionPackageOptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => method_exists($this->resource, 'getTranslations') ? $this->getTranslations('name') : $this->name,
            'description' => method_exists($this->resource, 'getTranslations') ? $this->getTranslations('description') : $this->description,
            'prices' => $this->prices->map(fn ($price) => [
                'id' => $price->id,
                'age_group_id' => $price->age_group_id,
                'age_group_name' => $price->ageGroup->name,
                'min_age' => $price->ageGroup->min_age,
                'max_age' => $price->ageGroup->max_age,
                'price' => $price->price,
            ]),
        ];
    }
}
