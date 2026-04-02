<?php

namespace App\Services\Admin;

use App\Models\Country;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CountryService
{
    public function listing($limit = 10, $search = null)
    {
        $query = Country::query();

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
        $country = Country::find($id);

        if (! $country) {
            throw new Exception('Country not found.');
        }

        return $country;
    }

    public function create($name, $dial_code)
    {
        $country = Country::create([
            'name' => $name,
            'dial_code' => $dial_code,
        ]);

        $country->update([
            'slug' => 'co'.$country->id.'-'.Str::slug($name),
        ]);

        return $country;
    }

    public function update($name, $dial_code, $id)
    {
        $country = Country::find($id);

        if (! $country) {
            throw new Exception('Country not found.');
        }

        $country->update([
            'name' => $name,
            'slug' => 'co'.$country->id.'-'.Str::slug($name),
            'dial_code' => $dial_code,
        ]);

        return $country;
    }

    public function delete($id)
    {
        $country = Country::find($id);

        if (! $country) {
            throw new Exception('Country not found.');
        }

        $country->delete();

        return true;
    }

    public function all()
    {
        $countries = Cache::rememberForever('countries_list', function () {
            return Country::orderBy('name')->get()->toArray();
        });

        return $countries;
    }
}
