<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AgeGroupService;
use Exception;
use Illuminate\Http\Request;

class AgeGroupController extends Controller
{
    public function __construct(public AgeGroupService $service)
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
            $ageGroups = $this->service->listing($request->limit, $request->search);

            return success([
                'total'        => $ageGroups->total(),
                'is_load_more' => $ageGroups->hasMorePages(),
                'age_groups'   => $ageGroups->getCollection(),
            ], 'Age groups retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $ageGroup = $this->service->find($id);

            return success([
                'age_group' => $ageGroup,
            ], 'Age group retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'min_age' => 'nullable|integer|min:0',
            'max_age' => 'nullable|integer|min:0',
        ]);

        try {
            $ageGroup = $this->service->create($request->name, $request->min_age, $request->max_age);

            return success([
                'age_group' => $ageGroup,
            ], 'Age group created successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'min_age' => 'nullable|integer|min:0',
            'max_age' => 'nullable|integer|min:0',
        ]);

        try {
            $ageGroup = $this->service->update($id, $request->name, $request->min_age, $request->max_age);

            return success([
                'age_group' => $ageGroup,
            ], 'Age group updated successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);

            return success([], 'Age group deleted successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }
}
