<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttractionPrice extends Model
{
    protected $table = 'attraction_prices';

    protected $fillable = [
        'attraction_package_id',
        'age_group_id',
        'price',
    ];

    protected $casts = [
        'price' => 'float',
    ];
}
