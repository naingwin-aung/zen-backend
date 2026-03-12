<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Services\Admin\CategoryService;

class CategoryController extends Controller
{
    public function __construct(public CategoryService $service)
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
            $categories = $this->service->listing($request->limit, $request->search);

            return success([
                'total'        => $categories->total(),
                'is_load_more' => $categories->hasMorePages(),
                'categories'    => $categories->getCollection(),
            ], 'Categories retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $category = $this->service->find($id);

            return success([
                'category' => $category,
            ], 'Category retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $category = $this->service->create($request->name);

            return success([
                'category' => $category,
            ], 'Category created successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $category = $this->service->update($request->name, $id);

            return success([
                'category' => $category,
            ], 'Category updated successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);

            return success([], 'Category deleted successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }
}
