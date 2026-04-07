<?php
namespace App\Services\Admin;

use App\Models\AgeGroup;
use Exception;
use Illuminate\Support\Facades\Cache;

class AgeGroupService
{
    public function listing($limit = 10, $search = null)
    {
        $query = AgeGroup::query();

        if ($search) {
            $query->where('name', 'like', "%$search%");
        }

        $data = $query
            ->orderBy('id', 'desc')
            ->paginate($limit)
            ->withQueryString();

        return $data;
    }

    public function find($id)
    {
        $ageGroup = AgeGroup::find($id);

        if (!$ageGroup) {
            throw new Exception('Age group not found.');
        }

        return $ageGroup;
    }

    public function create($name, $min_age, $max_age)
    {
        $ageGroup = AgeGroup::create([
            'name'    => $name,
            'min_age' => $min_age ?? null,
            'max_age' => $max_age ?? null,
        ]);

        return $ageGroup;
    }

    public function update($id, $name, $min_age, $max_age)
    {
        $ageGroup = AgeGroup::find($id);

        if (!$ageGroup) {
            throw new Exception('Age group not found.');
        }

        $ageGroup->update([
            'name'    => $name,
            'min_age' => $min_age ?? null,
            'max_age' => $max_age ?? null,
        ]);

        return $ageGroup;
    }

    public function delete($id)
    {
        $ageGroup = AgeGroup::find($id);

        if (!$ageGroup) {
            throw new Exception('Age group not found.');
        }

        $ageGroup->delete();

        return true;
    }

    public function all()
    {
        $ageGroups = Cache::rememberForever('age_groups_list', function () {
            return AgeGroup::select('id', 'name', 'min_age', 'max_age')->orderBy('name')->get()->toArray();
        });

        return $ageGroups;
    }
}