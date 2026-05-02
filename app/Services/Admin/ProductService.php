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
                $query->whereRaw('LOWER(name) LIKE ?', ["%".strtolower($search)."%"])
                    ->orWhereRaw('LOWER(search_keywords) LIKE ?', ["%".strtolower($search)."%"]);
            });
        }

        $data = $query
            ->orderBy('id', 'desc')
            ->paginate($limit)
            ->withQueryString();

        return $data;
    }
}