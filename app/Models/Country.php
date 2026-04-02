<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        'name',
        'slug',
        'dial_code',
    ];

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('countries_list');
        });

        static::deleted(function () {
            Cache::forget('countries_list');
        });
    }
}
