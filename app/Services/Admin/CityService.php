<?php

namespace App\Services\Admin;

use App\Models\City;
use Exception;
use Illuminate\Support\Str;

class CityService
{
    public function listing($limit = 10, $search = null, $countryId = null)
    {
        $query = City::with('country');

        if (isset($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('country', function ($q2) use ($search) {
                        $q2->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        if (isset($countryId)) {
            $query->where('country_id', $countryId);
        }

        $data = $query
            ->orderBy('id', 'desc')
            ->paginate($limit)
            ->withQueryString();

        return $data;
    }

    public function find($id)
    {
        $city = City::with('country')->find($id);

        if (!$city) {
            throw new Exception('City not found.');
        }

        return $city;
    }

    public function create($name, $countryId)
    {
        $city = City::create([
            'name'       => $name,
            'country_id' => $countryId,
        ]);

        $city->update([
            'slug' => 'c' . $city->id . '-' . Str::slug($name),
        ]);

        return $city->load('country');
    }

    public function update($name, $countryId, $id)
    {
        $city = City::find($id);

        if (!$city) {
            throw new Exception('City not found.');
        }

        $city->update([
            'name'       => $name,
            'slug'       => 'c' . $city->id . '-' . Str::slug($name),
            'country_id' => $countryId,
        ]);

        return $city->load('country');
    }

    public function delete($id)
    {
        $city = City::find($id);

        if (!$city) {
            throw new Exception('City not found.');
        }

        $city->delete();

        return true;
    }
}
