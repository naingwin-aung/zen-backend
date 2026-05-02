<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCity extends Model
{
    protected $table = 'product_cities';

    protected $fillable = [
        'product_id',
        'city_id',
    ];
}
