<?php
namespace App\Services\Admin;

use App\Enums\ServiceEnum;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CruiseService
{
    public function listing($limit = 10, $search = null)
    {
        $query = Product::query();

        if ($search) {
            $query = $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('search_keywords', 'LIKE', "%{$search}%");
            });
        }

        $data = $query
            ->where('service', ServiceEnum::CRUISE->value)
            ->orderBy('id', 'desc')
            ->paginate($limit)
            ->withQueryString();

        return $data;
    }

    public function find($id)
    {
        $cruise = Product::with('images', 'categories', 'countries')
            ->where('service', ServiceEnum::CRUISE->value)
            ->find($id);

        if (!$cruise) {
            throw new Exception('Cruise not found.');
        }

        return $cruise;
    }

    public function create(array $data)
    {
        $cruise = Product::create([
            'name'       => $data['name'],
            'service'    => ServiceEnum::CRUISE->value,
        ]);

        $noSpaceName             = str_replace(' ', '', strtolower($cruise->name));
        $cruise->search_keywords = "{$noSpaceName}, " . ($data['search_keywords'] ?? '');

        $cruise->update([
            'slug'            => $cruise->id . '-' . Str::slug($cruise->name),
            'search_keywords' => $cruise->search_keywords,
        ]);

        if(isset($data['countries'])) {
            $cruise->countries()->sync($data['countries']);
        }

        if (isset($data['categories'])) {
            $cruise->categories()->sync($data['categories']);
        }

        if (isset($data['images'])) {
            $this->_createImages($cruise, $data['images']);
        }

        return $cruise;
    }

    public function update($id, array $data)
    {
        $cruise = $this->find($id);

        $noSpaceName             = str_replace(' ', '', strtolower($data['name']));
        $cruise->search_keywords = "{$noSpaceName}, " . ($data['search_keywords'] ?? '');

        $cruise->update([
            'name'            => $data['name'],
            'slug'            => $cruise->id . '-' . Str::slug($data['name']),
            'search_keywords' => $cruise->search_keywords,
        ]);

        if(isset($data['countries'])) {
            $cruise->countries()->sync($data['countries']);
        }

        if (isset($data['categories'])) {
            $cruise->categories()->sync($data['categories']);
        }

        // start handle product images
        if (!empty($data['old_images'])) {
            if ($cruise->images->count() <= 1 && empty($data['images'])) {
                throw new Exception('At least one image is required for the cruise.');
            }

            $files = $cruise->images()
                ->whereIn('id', $data['old_images'] ?? [])
                ->get();

            if (count($files) > 0) {
                foreach ($files as $file) {
                    $oldImage = $file->getRawOriginal('url') ?? '';
                    Storage::delete($oldImage);
                }

                $cruise->images()->whereIn('id', $data['old_images'])->delete();
            }
        }

        if (isset($data['images'])) {
            $this->_createImages($cruise, $data['images']);
        }

        return $cruise;
    }

    public function delete($id)
    {
        $cruise = Product::where('service', ServiceEnum::CRUISE->value)->find($id);

        if (!$cruise) {
            throw new Exception('Cruise not found.');
        }

        $cruise->delete();
    }

    private function _createImages($product, $files)
    {
        $imageArray = [];

        foreach ($files as $image) {
            $imageArray[] = [
                'product_id' => $product->id,
                'url'        => storeImage('cruise_images', $image),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (count($imageArray) > 0) {
            $product->images()->createMany($imageArray);
        }
    }
}