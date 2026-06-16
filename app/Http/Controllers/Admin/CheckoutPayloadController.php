<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\CheckoutPayloadService;
use Exception;
use Illuminate\Http\Request;

class CheckoutPayloadController extends Controller
{
    public function __construct(public CheckoutPayloadService $service)
    {
        //
    }

    public function show(string $guid)
    {
        try {
            $result = $this->service->show($guid);

            return success([
                'guid' => $guid,
                'payload' => $result->payload,
            ], 'Shopping carts retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'payload' => 'required',
        ]);

        try {
            $result = $this->service->create($validated);

            return success([
                'guid' => $result->guid,
            ], 'Shopping carts created successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }
}
