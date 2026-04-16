<?php

namespace App\Services\Admin;

use App\Enums\ClosingTypeEnum;
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
        $attraction = Product::with('images', 'categories', 'countries', 'cities', 'attractionPackages.prices', 'detail', 'schedule')
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
            'name'    => $data['name'],
            'service' => ServiceEnum::ATTRACTION->value,
        ]);

        $noSpaceName                 = str_replace(' ', '', strtolower($attraction->name));
        $attraction->search_keywords = "{$noSpaceName}, " . ($data['search_keywords'] ?? '');

        $attraction->update([
            'slug'            => $attraction->id . '-' . Str::slug($attraction->name),
            'search_keywords' => $attraction->search_keywords,
        ]);

        // create product detail
        $attraction->detail()->create([
            'what_to_expect' => $data['what_to_expect'] ?? null,
            'good_to_know'   => $data['good_to_know'] ?? null,
            'highlights'     => $data['highlights'] ?? null,
        ]);

        // create product schedule
        $attraction->schedule()->create([
            'start_date'    => $data['start_date'] ?? null,
            'end_date'      => $data['end_date'] ?? null,
            'closing_type'  => $data['closing_type'] ?? null,
            'closing_dates' => isset($data['closing_type']) && $data['closing_type'] === ClosingTypeEnum::CLOSING_DATES->value ? $data['closing_dates'] : [],
            'closing_days'  => isset($data['closing_type']) && $data['closing_type'] === ClosingTypeEnum::CLOSING_DAYS->value ? $data['closing_days'] : [],
        ]);

        if (isset($data['countries'])) {
            $attraction->countries()->sync($data['countries']);
        }

        if (isset($data['cities'])) {
            $attraction->cities()->sync($data['cities']);
        }

        if (isset($data['categories'])) {
            $attraction->categories()->sync($data['categories']);
        }

        if (isset($data['images'])) {
            $this->_createImages($attraction, $data['images']);
        }

        // handle package option
        if (isset($data['packages']) && is_array($data['packages'])) {
            foreach ($data['packages'] as $package) {
                $attractionPackage = $attraction->attractionPackages()->create([
                    'name'        => $package['name'],
                    'description' => $package['description'] ?? null,
                ]);

                if (isset($package['prices']) && is_array($package['prices'])) {
                    foreach ($package['prices'] as $price) {
                        $attractionPackage->prices()->create([
                            'age_group_id' => $price['age_group_id'],
                            'price'        => $price['price'],
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

        $noSpaceName                 = str_replace(' ', '', strtolower($data['name']));
        $attraction->search_keywords = "{$noSpaceName}, " . ($data['search_keywords'] ?? '');

        $attraction->update([
            'name'            => $data['name'],
            'slug'            => $attraction->id . '-' . Str::slug($data['name']),
            'search_keywords' => $attraction->search_keywords,
        ]);

        // update product detail
        $attraction->detail->update([
            'what_to_expect' => $data['what_to_expect'] ?? null,
            'good_to_know'   => $data['good_to_know'] ?? null,
            'highlights'     => $data['highlights'] ?? null,
        ]);

        // update product schedule
        $attraction->schedule->update([
            'start_date'    => $data['start_date'] ?? null,
            'end_date'      => $data['end_date'] ?? null,
            'closing_type'  => $data['closing_type'] ?? null,
            'closing_dates' => isset($data['closing_type']) && $data['closing_type'] === ClosingTypeEnum::CLOSING_DATES->value ? $data['closing_dates'] : [],
            'closing_days'  => isset($data['closing_type']) && $data['closing_type'] === ClosingTypeEnum::CLOSING_DAYS->value ? $data['closing_days'] : [],
        ]);

        if (isset($data['countries'])) {
            $attraction->countries()->sync($data['countries']);
        }

        if (isset($data['cities'])) {
            $attraction->cities()->sync($data['cities']);
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

        // handle package option
        if (isset($data['packages']) && is_array($data['packages'])) {
            $requestPackageIds = collect($data['packages'])->pluck('id')->filter(function ($id) {
                return is_numeric($id);
            });

            if ($requestPackageIds->isNotEmpty()) {
                $attraction->attractionPackages()->whereNotIn('id', $requestPackageIds)->delete();
            } else {
                $attraction->attractionPackages()->delete();
            }

            foreach ($data['packages'] as $package) {
                $currentPackage = null;

                if ($package['id'] && is_numeric($package['id'])) {
                    $currentPackage = $attraction->attractionPackages()->where('id', $package['id'])->first();

                    if ($currentPackage) {
                        $currentPackage->update([
                            'name'        => $package['name'],
                            'description' => $package['description'] ?? null,
                        ]);

                        // prices handling
                        $requestPriceIds = collect($package['prices'])->pluck('id')->filter(function ($id) {
                            return is_numeric($id);
                        });

                        if ($requestPriceIds->isNotEmpty()) {
                            $currentPackage->prices()->whereNotIn('id', $requestPriceIds)->delete();
                        } else {
                            $currentPackage->prices()->delete();
                        }

                        foreach ($package['prices'] as $price) {
                            $currentPrice = null;

                            if (isset($price['id']) && is_numeric($price['id'])) {
                                $currentPrice = $currentPackage->prices()->where('id', $price['id'])->first();

                                if ($currentPrice) {
                                    $currentPrice->update([
                                        'age_group_id' => $price['age_group_id'],
                                        'price'        => $price['price'],
                                    ]);
                                }
                            } else {
                                $currentPackage->prices()->create([
                                    'age_group_id' => $price['age_group_id'],
                                    'price'        => $price['price'],
                                ]);
                            }
                        }
                    }
                } else {
                    // create new package
                    $currentPackage = $attraction->attractionPackages()->create([
                        'name'        => $package['name'],
                        'description' => $package['description'] ?? null,
                    ]);

                    // create new prices
                    if (isset($package['prices']) && is_array($package['prices'])) {
                        foreach ($package['prices'] as $price) {
                            $currentPackage->prices()->create([
                                'age_group_id' => $price['age_group_id'],
                                'price'        => $price['price'],
                            ]);
                        }
                    }
                }
            }
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
