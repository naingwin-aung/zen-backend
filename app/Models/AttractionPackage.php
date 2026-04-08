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
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    public function prices()
    {
        return $this->hasMany(AttractionPrice::class, 'attraction_package_id');
    }
}
