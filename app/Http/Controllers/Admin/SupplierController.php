<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\SupplierService;
use Exception;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function __construct(public SupplierService $service)
    {
        //
    }

    public function index(Request $request)
    {
        $request->validate([
            'page' => 'required|integer|min:1',
            'limit' => 'required|integer|min:1|max:100',
            'search' => 'nullable|string|max:255',
        ]);

        try {
            $suppliers = $this->service->listing($request->limit, $request->search);

            return success([
                'total' => $suppliers->total(),
                'is_load_more' => $suppliers->hasMorePages(),
                'suppliers' => $suppliers->getCollection(),
            ], 'Suppliers retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $supplier = $this->service->find($id);

            return success([
                'supplier' => $supplier,
            ], 'Supplier retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email',
            'password' => 'required|string|min:8',
            'profile' => 'nullable|image|max:2048',
        ]);

        try {
            $supplier = $this->service->create($request->name, $request->email, $request->password, $request->profile);

            return success([
                'supplier' => $supplier,
            ], 'Supplier created successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email,'.$id,
            'password' => 'nullable|string|min:8',
            'profile' => 'nullable|image|max:2048',
        ]);

        try {
            $supplier = $this->service->update($id, $request->name, $request->email, $request->password, $request->profile);

            return success([
                'supplier' => $supplier,
            ], 'Supplier updated successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);

            return success([], 'Supplier deleted successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }
}
