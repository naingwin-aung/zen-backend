<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSchedule extends Model
{
    protected $table = 'product_schedules';

    protected $fillable = [
        'product_id',
        'start_date',
        'end_date',
        'closing_type',
        'closing_dates',
        'closing_days',
    ];

    protected $casts = [
        'closing_dates' => 'array',
        'closing_days' => 'array',
    ];
}
