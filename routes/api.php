<?php

use App\Http\Controllers\Api\ProductCategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/user', [UserController::class, 'fetch']);
    Route::post('/user', [UserController::class, 'updateProfile']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/transaction', [TransactionController::class, 'all']);    
    Route::get('/checkout', [TransactionController::class, 'checkout']);    
});

Route::get('/products', [ProductController::class, 'all']);
Route::get('/categories', [ProductCategoryController::class, 'all']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);