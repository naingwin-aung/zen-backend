<?php

namespace App\Http\Resources\Admin\Product;

use App\Enums\ClosingTypeEnum;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductScheduleResource extends JsonResource
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
            'start_date' => Carbon::parse($this->start_date)->isPast() ? now()->format('Y-m-d') : $this->start_date,
            'end_date' => $this->end_date,
            'closing_dates' => [],
        ];

        if ($this->closing_type == ClosingTypeEnum::CLOSING_DATES->value) {
            $result['closing_dates'] = array_filter($this->closing_dates ?? [], function ($date) {
                return Carbon::parse($date)->startOfDay()->gte(today());
            });
        } elseif ($this->closing_type == ClosingTypeEnum::CLOSING_DAYS->value) {
            $result['closing_dates'] = generateDatesFromClosingDays($this->closing_days ?? [], $this->start_date, $this->end_date);
        }

        return $result;
    }
}
