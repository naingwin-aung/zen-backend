<?php
namespace App\Services\Admin;

use App\Enums\ServiceEnum;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AttractionService
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
            ->where('service', ServiceEnum::ATTRACTION->value)
            ->orderBy('id', 'desc')
            ->paginate($limit)
            ->withQueryString();

        return $data;
    }

    public function find($id)
    {
        $attraction = Product::with('images', 'categories', 'countries', 'attractionPackages.prices')
            ->where('service', ServiceEnum::ATTRACTION->value)
            ->find($id);

        if (!$attraction) {
            throw new Exception('Attraction not found.');
        }

        return $attraction;
    }

    public function create(array $data)
    {
        $attraction = Product::create([
            'name'       => $data['name'],
            'service'    => ServiceEnum::ATTRACTION->value,
        ]);

        $noSpaceName             = str_replace(' ', '', strtolower($attraction->name));
        $attraction->search_keywords = "{$noSpaceName}, " . ($data['search_keywords'] ?? '');

        $attraction->update([
            'slug'            => $attraction->id . '-' . Str::slug($attraction->name),
            'search_keywords' => $attraction->search_keywords,
        ]);

        if(isset($data['countries'])) {
            $attraction->countries()->sync($data['countries']);
        }

        if (isset($data['categories'])) {
            $attraction->categories()->sync($data['categories']);
        }

        if (isset($data['images'])) {
            $this->_createImages($attraction, $data['images']);
        }

        // handle package option
        if(isset($data['packages']) && is_array($data['packages'])) {
            foreach ($data['packages'] as $package) {
                $attractionPackage = $attraction->attractionPackages()->create([
                    'name' => $package['name'],
                    'description' => $package['description'] ?? null,
                    'start_date' => $package['start_date'],
                    'end_date' => $package['end_date'],
                ]);

                if (isset($package['prices']) && is_array($package['prices'])) {
                    foreach ($package['prices'] as $price) {
                        $attractionPackage->prices()->create([
                            'age_group_id' => $price['age_group_id'],
                            'price' => $price['price'],
                        ]);
                    }
                }
            }
        }

        return $attraction;
    }

    public function update($id, array $data)
    {
        $attraction = $this->find($id);

        $noSpaceName             = str_replace(' ', '', strtolower($data['name']));
        $attraction->search_keywords = "{$noSpaceName}, " . ($data['search_keywords'] ?? '');

        $attraction->update([
            'name'            => $data['name'],
            'slug'            => $attraction->id . '-' . Str::slug($data['name']),
            'search_keywords' => $attraction->search_keywords,
        ]);

        if(isset($data['countries'])) {
            $attraction->countries()->sync($data['countries']);
        }

        if (isset($data['categories'])) {
            $attraction->categories()->sync($data['categories']);
        }

        // start handle product images
        if (!empty($data['old_images'])) {
            if ($attraction->images->count() <= 1 && empty($data['images'])) {
                throw new Exception('At least one image is required for the attraction.');
            }

            $files = $attraction->images()
                ->whereIn('id', $data['old_images'] ?? [])
                ->get();

            if (count($files) > 0) {
                foreach ($files as $file) {
                    $oldImage = $file->getRawOriginal('url') ?? '';
                    Storage::delete($oldImage);
                }

                $attraction->images()->whereIn('id', $data['old_images'])->delete();
            }
        }

        if (isset($data['images'])) {
            $this->_createImages($attraction, $data['images']);
        }

        return $attraction;
    }

    public function delete($id)
    {
        $attraction = Product::where('service', ServiceEnum::ATTRACTION->value)->find($id);

        if (!$attraction) {
            throw new Exception('Attraction not found.');
        }

        $attraction->delete();
    }

    private function _createImages($product, $files)
    {
        $imageArray = [];

        foreach ($files as $image) {
            $imageArray[] = [
                'product_id' => $product->id,
                'url'        => storeImage('attraction_images', $image),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (count($imageArray) > 0) {
            $product->images()->createMany($imageArray);
        }
    }
}