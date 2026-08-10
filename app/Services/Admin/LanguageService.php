<?php

namespace App\Services\Admin;

use App\Models\Language;
use Exception;
use Illuminate\Support\Facades\Cache;

class LanguageService
{
    public function listing(int $limit = 10, ?string $search = null)
    {
        $query = Language::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('code', 'LIKE', '%' . $search . '%');
            });
        }

        return $query->orderBy('id', 'desc')
            ->paginate($limit)
            ->withQueryString();
    }

    public function find(int $id): Language
    {
        $language = Language::find($id);

        if (!$language) {
            throw new Exception('Language not found.');
        }

        return $language;
    }

    public function create(array $data): Language
    {
        $data['code'] = strtolower(trim($data['code']));

        $existing = Language::where('code', $data['code'])->first();
        if ($existing) {
            throw new Exception('Language with code "' . $data['code'] . '" already exists.');
        }

        return Language::create([
            'name' => $data['name'],
            'code' => $data['code'],
        ]);
    }

    public function update(int $id, array $data): Language
    {
        $language = $this->find($id);

        if (isset($data['code'])) {
            $data['code'] = strtolower(trim($data['code']));
            $existing = Language::where('code', $data['code'])->where('id', '!=', $id)->first();
            if ($existing) {
                throw new Exception('Language with code "' . $data['code'] . '" already exists.');
            }
        }

        $language->update($data);

        return $language;
    }

    public function delete(int $id): bool
    {
        $language = $this->find($id);

        if (strtolower($language->code) === 'en') {
            throw new Exception('Default fallback language (English) cannot be deleted.');
        }

        return $language->delete();
    }

    public function all()
    {
        return Cache::rememberForever('all_languages_list', function () {
            return Language::get()->toArray();
        });
    }

    public function getCodes(): array
    {
        return Cache::rememberForever('active_languages', function () {
            $codes = Language::pluck('code')->map(fn($c) => strtolower($c))->toArray();
            if (!in_array('en', $codes, true)) {
                $codes[] = 'en';
            }

            return array_values(array_unique($codes));
        });
    }
}
