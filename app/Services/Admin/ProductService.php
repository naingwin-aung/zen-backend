<?php

namespace App\Services\Admin;

use App\Exceptions\MyException;
use App\Models\Product;
use Carbon\Carbon;

class ProductService
{
    public function listing(int $limit, ?string $search = null)
    {
        $query = Product::with([
            'categories',
            'images',
            'countries',
            'cities',
        ]);

        if ($search) {
            $query = $query->where(function ($query) use ($search) {
                $query->whereRaw('LOWER(name) LIKE ?', ["%" . strtolower($search) . "%"])
                    ->orWhereRaw('LOWER(search_keywords) LIKE ?', ["%" . strtolower($search) . "%"]);
            });
        }

        $data = $query
            ->where('is_active', true)
            ->orderBy('id', 'desc')
            ->paginate($limit)
            ->withQueryString();

        return $data;
    }

    public function show(string $slug)
    {
        $query = Product::with([
            'categories',
            'images',
            'countries',
            'cities',
            'detail',
            'schedule' => function ($query) {
                $query->where('end_date', '>=', Carbon::now()->startOfDay());
            },
            'attractionPackages.prices'
        ]);

        $data = $query->where('slug', $slug)
            ->where('is_active', true)
            ->first();

        if (!$data) {
            throw new MyException('Product not found.');
        }

        return $data;
    }
}
