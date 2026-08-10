<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\CityService;
use Exception;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct(public CityService $service)
    {
        //
    }

    public function index(Request $request)
    {
        $request->validate([
            'page' => 'required|integer|min:1',
            'limit' => 'required|integer|min:1|max:100',
            'search' => 'nullable|string|max:255',
            'country_id' => 'nullable|integer',
        ]);

        try {
            $cities = $this->service->listing($request->limit, $request->search, $request->country_id);

            return success([
                'total' => $cities->total(),
                'is_load_more' => $cities->hasMorePages(),
                'cities' => $cities->getCollection(),
            ], 'Cities retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $city = $this->service->find($id);

            return success([
                'city' => $city,
            ], 'City retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|integer|exists:countries,id',
        ]);

        try {
            $city = $this->service->create($request->name, $request->country_id);

            return success([
                'city' => $city,
            ], 'City created successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|integer|exists:countries,id',
        ]);

        try {
            $city = $this->service->update($request->name, $request->country_id, $id);

            return success([
                'city' => $city,
            ], 'City updated successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);

            return success([], 'City deleted successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }
}
