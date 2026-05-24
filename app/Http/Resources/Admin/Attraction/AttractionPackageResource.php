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
    public function toArray(Request $request) : array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'min_price' => $this->min_price
        ];
    }
}
