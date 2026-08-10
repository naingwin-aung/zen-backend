<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\LanguageService;
use Exception;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function __construct(public LanguageService $service)
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
            $languages = $this->service->listing($request->limit, $request->search);

            return success([
                'total' => $languages->total(),
                'is_load_more' => $languages->hasMorePages(),
                'languages' => $languages->getCollection(),
            ], 'Languages retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function show(int $id)
    {
        try {
            $language = $this->service->find($id);

            return success([
                'language' => $language,
            ], 'Language retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function clone(int $id)
    {
        try {
            $language = $this->service->clone($id);

            return success([
                'language' => $language,
            ], 'Language clone data retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10',
        ]);

        try {
            $language = $this->service->create($request->only(['name', 'code']));

            return success([
                'language' => $language,
            ], 'Language created successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10',
        ]);

        try {
            $language = $this->service->update($id, $request->only(['name', 'code']));

            return success([
                'language' => $language,
            ], 'Language updated successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->service->delete($id);

            return success(null, 'Language deleted successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }

    public function all()
    {
        try {
            $languages = $this->service->all();

            return success([
                'languages' => $languages,
            ], 'All languages retrieved successfully.');
        } catch (Exception $e) {
            return error($e->getMessage());
        }
    }
}
