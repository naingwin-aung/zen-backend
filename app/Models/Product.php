<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'service',
        'search_keywords',
        'star_rating',
        'price',
    ];

    protected $casts = [
        'star_rating' => 'float',
        'price' => 'float',
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

    public function cities()
    {
        return $this->belongsToMany(City::class, 'product_cities');
    }

    public function attractionPackages()
    {
        return $this->hasMany(AttractionPackage::class, 'product_id');
    }

    public function detail()
    {
        return $this->hasOne(ProductDetail::class, 'product_id');
    }

    public function schedule()
    {
        return $this->hasOne(ProductSchedule::class, 'product_id');
    }
}
