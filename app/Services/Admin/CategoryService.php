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
        $category = Category::find($id);

        if (!$category) {
            throw new Exception('Category not found.');
        }

        return $category;
    }

    public function create($name)
    {
        $category = Category::create([
            'name'      => $name,
        ]);

        $category->update([
            'slug' => $category->id . '-' . Str::slug($name),
        ]);

        return $category;
    }

    public function update($name, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            throw new Exception('Category not found.');
        }

        $category->update([
            'name'      => $name,
            'slug'      => $category->id . '-' . Str::slug($name),
        ]);

        return $category;
    }

    public function delete($id)
    {
        $category = Category::find($id);

        if (!$category) {
            throw new Exception('Category not found.');
        }

        $category->delete();

        return true;
    }
}