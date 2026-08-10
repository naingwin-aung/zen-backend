<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations, SoftDeletes;

    protected $table = 'categories';

    public array $translatable = ['name'];

    protected $fillable = [
        'name',
        'slug',
    ];
}
