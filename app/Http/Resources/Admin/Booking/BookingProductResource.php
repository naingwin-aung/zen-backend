<?php

namespace App\Http\Resources\Admin\Booking;

use App\Http\Resources\Admin\Booking\Attraction\BookingAttractionResource;
use App\Enums\ServiceEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request) : array
    {
        $result = [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'booking_number' => $this->booking_number,
            'booking_status' => $this->booking_status,
            'sub_total' => $this->sub_total,
            'grand_total' => $this->grand_total,
            'service' => $this->service(),
            'created_at' => $this->created_at,
        ];

        switch ($result['service']) {
            case ServiceEnum::ATTRACTION->value: {
                $result['attraction'] = new BookingAttractionResource($this->whenLoaded('bookingAttraction'));
                break;
            }
        }

        return $result;
    }

    /**
     * Resolve the booked service from the loaded service booking.
     */
    private function service() : ?string
    {
        return match (true) {
            $this->relationLoaded('bookingAttraction') && $this->bookingAttraction => ServiceEnum::ATTRACTION->value,
            default => null,
        };
    }
}
