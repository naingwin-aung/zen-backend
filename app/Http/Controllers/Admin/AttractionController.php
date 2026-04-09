<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AttractionService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttractionController extends Controller
{
    public function __construct(public AttractionService $service)
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
            $attractions = $this->service->listing($request->limit, $request->search);

            return success([
                'total'        => $attractions->total(),
                'is_load_more' => $attractions->hasMorePages(),
                'attractions'  => $attractions->getCollection(),
            ], 'Attractions retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $attraction = $this->service->find($id);

            return success([
                'attraction' => $attraction,
            ], 'Attraction retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'                             => 'required|string|max:255',
            'countries'                        => 'required|array',
            'countries.*'                      => 'required|integer',
            'images'                           => 'required|array',
            'images.*'                         => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp,heic|max:2048',
            'categories'                       => 'required|array',
            'categories.*'                     => 'required|integer|exists:categories,id',
            'what_to_expect'                   => 'required|string',
            'good_to_know'                     => 'nullable|string',
            'highlights'                       => 'nullable|string',
            'search_keywords'                  => 'nullable|string',
            'packages'                         => 'required|array',
            'packages.*.name'                  => 'required_with:packages|string|max:255',
            'packages.*.description'           => 'nullable|string',
            'packages.*.start_date'            => 'required_with:packages|date',
            'packages.*.end_date'              => 'required_with:packages|date|after_or_equal:packages.*.start_date',
            'packages.*.prices'                => 'required_with:packages|array',
            'packages.*.prices.*.age_group_id' => 'required_with:packages.*.prices|integer|exists:age_groups,id',
            'packages.*.prices.*.price'        => 'required_with:packages.*.prices|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $attraction = $this->service->create($request->only('name', 'countries', 'images', 'categories', 'search_keywords', 'packages', 'what_to_expect', 'good_to_know', 'highlights'));

            DB::commit();

            return success([
                'attraction' => $attraction,
            ], 'Attraction created successfully.');
        } catch (Exception $e) {
            DB::rollBack();

            return error($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'                             => 'required|string|max:255',
            'countries'                        => 'required|array',
            'countries.*'                      => 'required|integer',
            'images'                           => 'nullable|array',
            'images.*'                         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,heic|max:2048',
            'old_images'                       => 'nullable|array',
            'old_images.*'                     => 'nullable|integer',
            'categories'                       => 'required|array',
            'categories.*'                     => 'required|integer|exists:categories,id',
            'search_keywords'                  => 'nullable|string',
            'what_to_expect'                   => 'required|string',
            'good_to_know'                     => 'nullable|string',
            'highlights'                       => 'nullable|string',
            'packages'                         => 'required|array',
            'packages.*.name'                  => 'required_with:packages|string|max:255',
            'packages.*.description'           => 'nullable|string',
            'packages.*.start_date'            => 'required_with:packages|date',
            'packages.*.end_date'              => 'required_with:packages|date|after_or_equal:packages.*.start_date',
            'packages.*.prices'                => 'required_with:packages|array',
            'packages.*.prices.*.age_group_id' => 'required_with:packages.*.prices|integer|exists:age_groups,id',
            'packages.*.prices.*.price'        => 'required_with:packages.*.prices|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $attraction = $this->service->update($id, $request->only('name', 'countries', 'images', 'old_images', 'categories', 'search_keywords', 'packages', 'what_to_expect', 'good_to_know', 'highlights'));

            DB::commit();

            return success([
                'attraction' => $attraction,
            ], 'Attraction updated successfully.');
        } catch (Exception $e) {
            DB::rollBack();

            return error($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);

            return success(null, 'Attraction deleted successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }
}
