<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AttractionPackage extends Model
{
    use HasTranslations;

    protected $table = 'attraction_packages';

    public array $translatable = ['name', 'description'];

    protected $fillable = [
        'product_id',
        'name',
        'description',
    ];

    public function prices()
    {
        return $this->hasMany(AttractionPrice::class, 'attraction_package_id');
    }

    public function getMinPriceAttribute()
    {
        if (! $this->relationLoaded('prices')) {
            return null;
        }

        return $this->prices->min('price');
    }
}
