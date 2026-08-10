<?php

namespace App\Http\Resources\Admin\Attraction;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttractionPackageResource extends JsonResource
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
            'min_price' => $this->min_price,
        ];
    }
}
