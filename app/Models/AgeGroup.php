<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class AgeGroup extends Model
{
    protected $table = 'age_groups';

    protected $fillable = [
        'name',
        'min_age',
        'max_age'
    ];

    protected $casts = [
        'min_age' => 'integer',
        'max_age' => 'integer',
    ];

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('age_groups_list');
        });

        static::deleted(function () {
            Cache::forget('age_groups_list');
        });
    }
}
