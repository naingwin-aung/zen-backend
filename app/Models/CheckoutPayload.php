<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckoutPayload extends Model
{
    public $table = 'checkout_payloads';

    public $fillable = [
        'guid',
        'payload',
        'status',
    ];

    protected $casts = [
        'payload' => 'json'
    ];
}
