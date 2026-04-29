<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Attraction\StoreRequest;
use App\Http\Requests\Admin\Attraction\UpdateRequest;
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

    public function show(int $id)
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

    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $attraction = $this->service->create($request->validated());

            DB::commit();

            return success([
                'attraction' => $attraction,
            ], 'Attraction created successfully.');
        } catch (Exception $e) {
            DB::rollBack();

            return error($e->getMessage());
        }
    }

    public function update(UpdateRequest $request, int $id)
    {
        DB::beginTransaction();
        try {
            $attraction = $this->service->update($id, $request->validated());

            DB::commit();

            return success([
                'attraction' => $attraction,
            ], 'Attraction updated successfully.');
        } catch (Exception $e) {
            DB::rollBack();

            return error($e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->service->delete($id);

            return success(null, 'Attraction deleted successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }
}
