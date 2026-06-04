<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AgeGroupController;
use App\Http\Controllers\Admin\AttractionController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CheckoutController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:api')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', [AuthController::class, 'user']);
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::apiResource('admins', AdminController::class);
        Route::apiResource('countries', CountryController::class);
        Route::apiResource('cities', CityController::class);
        Route::apiResource('categories', CategoryController::class);

        Route::apiResource('attractions', AttractionController::class);

        Route::apiResource('age-groups', AgeGroupController::class);

        // all products routes
        Route::get('products', [ProductController::class, 'index']);
        Route::get('/products/{slug}', [ProductController::class, 'show']);

        // attractions
        Route::get('/attractions/{productId}/options/{id}', [AttractionController::class, 'option']);

        // Booking
        Route::get('bookings', [BookingController::class, 'index']);

        // Checkout
        Route::post('checkout', [CheckoutController::class, 'index']);

        // General routes
        Route::get('all-countries', [CountryController::class, 'all']);
        Route::get('all-age-groups', [AgeGroupController::class, 'all']);
    });
});
