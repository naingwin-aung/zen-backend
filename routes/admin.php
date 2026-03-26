<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CruiseController;
use Illuminate\Support\Facades\Route;

// Route::middleware('throttle:api')->group(function () {
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('countries', CountryController::class);
    Route::apiResource('categories', CategoryController::class);

    Route::apiResource('cruises', CruiseController::class);
});
// });
