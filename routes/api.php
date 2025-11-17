<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\BannerController;
use App\Http\Controllers\Api\V1\BrandController;
use App\Http\Controllers\Api\V1\CartController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\CategorySectionController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\WishlistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () { 
    Route::get('banners' , [BannerController::class, 'index']);
    Route::get('brands', [BrandController::class, 'index']);

    Route::get('products', [ProductController::class, 'index']);
    Route::get('products/{slug}', [ProductController::class, 'show']);

    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categories/{slug}', [CategoryController::class, 'show']);
    
    
    # auth
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    
    Route::middleware('throttle:5,1')->group(function () {
        // Route::post('password-forgot', [ForgotPasswordController::class, 'sendOtp']);
        // Route::post('password-reset', [ForgotPasswordController::class, 'reset']);
    });
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/logout-all', [AuthController::class, 'logoutAll']);

        Route::delete('wishlists', [WishlistController::class, 'clear'])->name('wishlists.clear');
        Route::apiResource('wishlists', WishlistController::class)->only('index', 'store', 'destroy');

        Route::delete('carts', [CartController::class, 'clear']);
        Route::apiResource('carts', CartController::class)->only('index', 'store', 'destroy');

        Route::apiResource('sections', CategorySectionController::class);
    });


});

