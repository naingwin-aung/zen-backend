<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttractionPackage extends Model
{
    protected $table = 'attraction_packages';

    protected $fillable = [
        'product_id',
        'name',
        'description',
    ];

    public function prices()
    {
        return $this->hasMany(AttractionPrice::class, 'attraction_package_id');
    }
}
