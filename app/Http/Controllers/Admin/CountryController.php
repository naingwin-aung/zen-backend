<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Services\Admin\CountryService;
use Exception;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __construct(public CountryService $service)
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
            $countries = $this->service->listing($request->limit, $request->search);

            return success([
                'total'        => $countries->total(),
                'is_load_more' => $countries->hasMorePages(),
                'countries'    => $countries->getCollection(),
            ], 'Countries retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $country = $this->service->find($id);

            return success([
                'country' => $country,
            ], 'Country retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dial_code' => 'required|string|max:10',
        ]);

        try {
            $country = $this->service->create($request->name, $request->dial_code);

            return success([
                'country' => $country,
            ], 'Country created successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dial_code' => 'required|string|max:10',
        ]);

        try {
            $country = $this->service->update($request->name, $request->dial_code, $id);

            return success([
                'country' => $country,
            ], 'Country updated successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);

            return success([], 'Country deleted successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }
}
