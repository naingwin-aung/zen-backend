<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\UserService;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(public UserService $service)
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
            $users = $this->service->listing($request->limit, $search = $request->search);

            return success([
                'total' => $users->total(),
                'is_load_more' => $users->hasMorePages(),
                'users' => $users->getCollection(),
            ], 'Users retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $user = $this->service->find($id);

            return success([
                'user' => $user,
            ], 'User retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:50',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'country_id' => 'nullable|integer|exists:countries,id',
            'dial_id' => 'nullable|integer|exists:countries,id',
            'phone_number' => 'nullable|string|max:50',
        ]);

        try {
            $user = $this->service->create($data);

            return success([
                'user' => $user,
            ], 'User created successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:50',
            'email' => 'required|email|max:255|unique:users,email,'.$id,
            'password' => 'nullable|string|min:8',
            'country_id' => 'nullable|integer|exists:countries,id',
            'dial_id' => 'nullable|integer|exists:countries,id',
            'phone_number' => 'nullable|string|max:50',
        ]);

        try {
            $user = $this->service->update($id, $data);

            return success([
                'user' => $user,
            ], 'User updated successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);

            return success([], 'User deleted successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }
}
