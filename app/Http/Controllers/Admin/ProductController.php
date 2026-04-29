<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ProductService;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(public ProductService $service)
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
            $products = $this->service->listing($request->limit, $request->search);

            return success([
                'total'        => $products->total(),
                'is_load_more' => $products->hasMorePages(),
                'products'     => $products->getCollection(),
            ], 'Products retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }
}
