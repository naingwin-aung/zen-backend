<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\CruiseService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CruiseController extends Controller
{
    public function __construct(public CruiseService $service)
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
            $cruises = $this->service->listing($request->limit, $request->search);

            return success([
                'total'        => $cruises->total(),
                'is_load_more' => $cruises->hasMorePages(),
                'cruises'      => $cruises->getCollection(),
            ], 'Cruises retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $cruise = $this->service->find($id);

            return success([
                'cruise' => $cruise,
            ], 'Cruise retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'country_id'   => 'required|integer|exists:countries,id',
            'images'       => 'required|array',
            'images.*'     => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp,heic|max:2048',
            'categories'   => 'required|array',
            'categories.*' => 'required|integer|exists:categories,id',
        ]);

        DB::beginTransaction();
        try {
            $cruise = $this->service->create($request->only('name', 'country_id', 'images', 'categories'));

            DB::commit();
            return success([
                'cruise' => $cruise,
            ], 'Cruise created successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return error($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'country_id'   => 'required|integer|exists:countries,id',
            'images'       => 'nullable|array',
            'images.*'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,heic|max:2048',
            'old_images'   => 'nullable|array',
            'old_images.*' => 'nullable|integer|exists:images,id',
            'categories'   => 'required|array',
            'categories.*' => 'required|integer|exists:categories,id',
        ]);

        DB::beginTransaction();
        try {
            $cruise = $this->service->update($id, $request->only('name', 'country_id', 'images', 'old_images', 'categories'));

            DB::commit();
            return success([
                'cruise' => $cruise,
            ], 'Cruise updated successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return error($e->getMessage());
        }
    }
}
