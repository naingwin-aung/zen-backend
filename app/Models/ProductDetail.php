<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table = 'product_details';

    protected $fillable = [
        'product_id',
        'what_to_expect',
        'good_to_know',
        'highlights',
    ];
}
