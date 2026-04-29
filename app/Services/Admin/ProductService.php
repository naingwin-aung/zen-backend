<?php
namespace App\Services\Admin;

use App\Models\Product;

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
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('search_keywords', 'like', "%{$search}%");
            });
        }

        $data = $query
            ->orderBy('id', 'desc')
            ->paginate($limit)
            ->withQueryString();

        return $data;
    }
}