<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    public $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'service',
        'search_keywords',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'product_countries');
    }

    public function attractionPackages()
    {
        return $this->hasMany(AttractionPackage::class, 'product_id');
    }

    public function detail()
    {
        return $this->hasOne(ProductDetail::class, 'product_id');
    }
}
