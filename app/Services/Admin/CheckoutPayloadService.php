<?php
namespace App\Services\Admin;

use App\Models\CheckoutPayload;
use Illuminate\Support\Str;

class CheckoutPayloadService
{
    public function show(string $guid)
    {
        $cart = CheckoutPayload::where('guid', $guid)
            ->firstOrFail();

        return $cart;
    }

    public function create(array $data)
    {
        $cart = CheckoutPayload::create([
            'guid' => Str::uuid(),
            'payload' => $data['payload'],
            'status' => 'active',
        ]);

        return $cart;
    }
}