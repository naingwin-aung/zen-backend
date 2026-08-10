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
            $locale = app()->getLocale();
            $languageService = app(LanguageService::class);
            $codes = $languageService->getCodes();

            $query = $query->where(function ($q) use ($search, $locale, $codes) {
                $q->where('name->'.$locale, 'LIKE', '%'.$search.'%');
                foreach ($codes as $code) {
                    $q->orWhere('name->'.$code, 'LIKE', '%'.$search.'%');
                }
            });
        }

        $locale = app()->getLocale();

        return $query
            ->orderBy('name->'.$locale)
            ->orderBy('id', 'desc')
            ->paginate($limit)
            ->withQueryString();
    }

    public function find($id)
    {
        $ageGroup = AgeGroup::find($id);

        if (! $ageGroup) {
            throw new Exception('Age group not found.');
        }

        return $ageGroup;
    }

    /**
     * Build the prefilled payload used to create a copy of an existing age group.
     *
     * @return array{clone_from: int, name: array<string, string>, min_age: ?int, max_age: ?int}
     */
    public function clone($id): array
    {
        $ageGroup = $this->find($id);

        return [
            'clone_from' => $ageGroup->id,
            'name' => $ageGroup->getTranslations('name'),
            'min_age' => $ageGroup->min_age,
            'max_age' => $ageGroup->max_age,
        ];
    }

    public function create($name, $min_age, $max_age)
    {
        return AgeGroup::create([
            'name' => $name,
            'min_age' => $min_age ?? null,
            'max_age' => $max_age ?? null,
        ]);
    }

    public function update($id, $name, $min_age, $max_age)
    {
        $ageGroup = AgeGroup::find($id);

        if (! $ageGroup) {
            throw new Exception('Age group not found.');
        }

        $ageGroup->update([
            'name' => $name,
            'min_age' => $min_age ?? null,
            'max_age' => $max_age ?? null,
        ]);

        return $ageGroup;
    }

    public function delete($id)
    {
        $ageGroup = AgeGroup::find($id);

        if (! $ageGroup) {
            throw new Exception('Age group not found.');
        }

        $ageGroup->delete();

        return true;
    }

    public function all()
    {
        $locale = app()->getLocale();

        return Cache::rememberForever('age_groups_list_'.$locale, function () {
            return AgeGroup::select('id', 'name', 'min_age', 'max_age')
                ->get()
                ->sortBy(function ($item) {
                    return strtolower((string) $item->name);
                })
                ->values()
                ->toArray();
        });
    }
}
