<?php

namespace App\Http\Resources\Admin\Booking;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingDetailResource extends JsonResource
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
            'payment_reference' => $this->payment_reference,
            'payment_status' => $this->payment_status,
            'sub_total' => $this->sub_total,
            'grand_total' => $this->grand_total,
            'buyer' => [
                'first_name' => data_get($this->buyer_info, 'first_name'),
                'last_name' => data_get($this->buyer_info, 'last_name'),
                'email' => data_get($this->buyer_info, 'email'),
                'dial_code' => data_get($this->buyer_info, 'dial_code'),
                'phone_number' => data_get($this->buyer_info, 'phone_number'),
                'nationality' => data_get($this->buyer_info, 'nationality'),
            ],
            'booking_products' => BookingProductResource::collection($this->whenLoaded('bookingProducts')),
            'created_at' => $this->created_at,
        ];
    }
}
