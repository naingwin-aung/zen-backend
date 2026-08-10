<?php

use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

Route::get('image/{filename}', [ApplicationController::class, 'image'])->where('filename', '.*');

Route::get('/', function () {
    return 'Backend is running';
});
