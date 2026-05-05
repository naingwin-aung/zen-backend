<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\BookingService;
use Exception;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __construct(public BookingService $service)
    {
        //
    }

    public function index(Request $request)
    {
        $request->validate([
            'page'   => 'required|integer|min:1',
            'limit'  => 'required|integer|min:1|max:100',
            'search' => 'nullable|string|max:255',
        ]);
        
        try {
            $bookings = $this->service->listing($request->limit, $request->search);

            return success([
                'total'        => $bookings->total(),
                'is_load_more' => $bookings->hasMorePages(),
                'bookings'     => $bookings->getCollection(),
            ], 'Bookings retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }
}
