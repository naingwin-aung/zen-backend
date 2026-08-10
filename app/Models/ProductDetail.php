<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ProductDetail extends Model
{
    use HasTranslations;

    protected $table = 'product_details';

    public array $translatable = ['what_to_expect', 'good_to_know', 'highlights'];

    protected $fillable = [
        'product_id',
        'what_to_expect',
        'good_to_know',
        'highlights',
    ];
}
