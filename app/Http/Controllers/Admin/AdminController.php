<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminService;
use Exception;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(public AdminService $service)
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
            $admins = $this->service->listing($request->limit, $request->search);

            return success([
                'total'        => $admins->total(),
                'is_load_more' => $admins->hasMorePages(),
                'admins'       => $admins->getCollection(),
            ], 'Admins retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $admin = $this->service->find($id);

            return success([
                'admin' => $admin,
            ], 'Admin retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8',
            'profile'  => 'nullable|image|max:2048',
        ]);

        try {
            $admin = $this->service->create($request->name, $request->email, $request->password, $request->profile);

            return success([
                'admin' => $admin,
            ], 'Admin created successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins,email,' . $id,
            'password' => 'nullable|string|min:8',
            'profile'  => 'nullable|image|max:2048',
        ]);

        try {
            $admin = $this->service->update($id, $request->name, $request->email, $request->password, $request->profile);

            return success([
                'admin' => $admin,
            ], 'Admin updated successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);

            return success([], 'Admin deleted successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }
}
