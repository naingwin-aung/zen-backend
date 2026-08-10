<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Language extends Model
{
    use HasFactory;

    protected $table = 'languages';

    protected $fillable = [
        'name',
        'code',
    ];

    protected static function booted(): void
    {
        static::saved(function () {
            Cache::forget('active_languages');
            Cache::forget('all_languages_list');
        });

        static::deleted(function () {
            Cache::forget('active_languages');
            Cache::forget('all_languages_list');
        });
    }
}
