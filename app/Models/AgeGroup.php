<?php

namespace App\Models;

use App\Services\Admin\LanguageService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class AgeGroup extends Model
{
    use HasTranslations;

    protected $table = 'age_groups';

    public array $translatable = ['name'];

    protected $fillable = [
        'name',
        'min_age',
        'max_age',
    ];

    protected $casts = [
        'min_age' => 'integer',
        'max_age' => 'integer',
    ];

    protected static function booted()
    {
        $forgetCache = function () {
            $codes = app(LanguageService::class)->getCodes();
            foreach ($codes as $code) {
                Cache::forget('age_groups_list_'.$code);
            }
            Cache::forget('age_groups_list');
        };

        static::saved($forgetCache);
        static::deleted($forgetCache);
    }
}
