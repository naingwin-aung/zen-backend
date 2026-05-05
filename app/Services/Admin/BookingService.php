<?php
namespace App\Services\Admin;

use App\Models\Booking;

class BookingService
{
    public function listing(int $limit, ?string $search = null)
    {
        $query = Booking::query();
        
        $data = $query
            ->orderBy('id', 'desc')
            ->paginate($limit)
            ->withQueryString();

        return $data;
    }
}