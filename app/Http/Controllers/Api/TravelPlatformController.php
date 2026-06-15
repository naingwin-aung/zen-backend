<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class TravelPlatformController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'destination' => 'required',
        ]);

        try {
            $products = Product::with([
                'categories',
                'images',
                'countries',
                'cities',
            ])
                ->where(function ($query) use ($request) {
                    $query->whereHas('cities', function ($query) use ($request) {
                        $query->whereRaw('LOWER(name) LIKE ?', ["%" . strtolower($request->destination) . "%"]);
                    })
                        ->orWhereHas('countries', function ($query) use ($request) {
                            $query->whereRaw('LOWER(name) LIKE ?', ["%" . strtolower($request->destination) . "%"]);
                        })
                        ->orWhereRaw('LOWER(name) LIKE ?', ["%" . strtolower($request->destination) . "%"])
                        ->orWhereRaw('LOWER(search_keywords) LIKE ?', ["%" . strtolower($request->destination) . "%"]);
                })
                ->limit(5)
                ->get();

            return success([
                'products' => $products,
            ], 'Product retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }
}
