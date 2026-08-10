<?php

namespace App\Services\Admin;

use App\Models\Category;
use Exception;
use Illuminate\Support\Str;

class CategoryService
{
    public function listing($limit = 10, $search = null)
    {
        $query = Category::query();

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
        $category = Category::find($id);

        if (! $category) {
            throw new Exception('Category not found.');
        }

        return $category;
    }

    public function create($name)
    {
        $category = Category::create([
            'name' => $name,
        ]);

        $slugBase = is_array($name) ? ($name['en'] ?? (current(array_filter($name)) ?: reset($name))) : $name;

        $category->update([
            'slug' => $category->id.'-'.Str::slug((string) $slugBase),
        ]);

        return $category;
    }

    public function update($name, $id)
    {
        $category = Category::find($id);

        if (! $category) {
            throw new Exception('Category not found.');
        }

        $slugBase = is_array($name) ? ($name['en'] ?? (current(array_filter($name)) ?: reset($name))) : $name;

        $category->update([
            'name' => $name,
            'slug' => $category->id.'-'.Str::slug((string) $slugBase),
        ]);

        return $category;
    }

    public function delete($id)
    {
        $category = Category::find($id);

        if (! $category) {
            throw new Exception('Category not found.');
        }

        $category->delete();

        return true;
    }
}
