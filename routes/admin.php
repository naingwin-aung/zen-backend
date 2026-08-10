<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AgeGroupController;
use App\Http\Controllers\Admin\AttractionController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CheckoutConfirmController;
use App\Http\Controllers\Admin\CheckoutController;
use App\Http\Controllers\Admin\CheckoutPayloadController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:api')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', [AuthController::class, 'user']);
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::apiResource('admins', AdminController::class);
        Route::apiResource('users', UserController::class);
        Route::apiResource('suppliers', SupplierController::class);
        Route::apiResource('countries', CountryController::class);
        Route::apiResource('cities', CityController::class);
        Route::apiResource('categories', CategoryController::class);

        Route::apiResource('attractions', AttractionController::class);

        Route::apiResource('age-groups', AgeGroupController::class);
        Route::apiResource('languages', LanguageController::class);

        // all products routes
        Route::get('products', [ProductController::class, 'index']);
        Route::get('/products/{slug}', [ProductController::class, 'show']);

        // attractions
        Route::get('/attractions/{productId}/options/{id}', [AttractionController::class, 'option']);

        // Booking
        Route::get('bookings', [BookingController::class, 'index']);
        Route::get('bookings/{id}', [BookingController::class, 'show']);

        // checkout payloads
        Route::get('checkout-payload/{guid}', [CheckoutPayloadController::class, 'show']);
        Route::post('checkout-payload', [CheckoutPayloadController::class, 'store']);

        // Checkout
        Route::post('checkout', [CheckoutController::class, 'index']);
        Route::post('checkout-confirm', [CheckoutConfirmController::class, 'index']);

        // General routes
        Route::get('all-countries', [CountryController::class, 'all']);
        Route::get('all-age-groups', [AgeGroupController::class, 'all']);
        Route::get('all-languages', [LanguageController::class, 'all']);
    });
});
