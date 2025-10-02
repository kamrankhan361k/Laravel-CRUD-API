<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\FileUploadController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Product routes (public read access)
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Product CRUD routes
    Route::apiResource('products', ProductController::class)->except(['index', 'show']);

    // File upload routes (separate from products)
    Route::prefix('upload')->group(function () {
        Route::post('/', [FileUploadController::class, 'upload']);
        Route::delete('/', [FileUploadController::class, 'delete']);
    });
});
