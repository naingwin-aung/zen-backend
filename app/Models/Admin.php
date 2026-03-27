<?php

namespace App\Models;

use App\Casts\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes;

    protected $table = 'admins';

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile'
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts() : array
    {
        return [
            'password' => 'hashed',
            'profile'  => Image::class,
        ];
    }
}
