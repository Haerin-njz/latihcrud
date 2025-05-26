<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Create account
Route::post('/register', [UserController::class, 'addAccount']);

// Login
Route::post('/login', [UserController::class, 'login']);

// Read account info
Route::get('/account-info/{id}', [UserController::class, 'getAccountInfo']);

// Read all accounts info
Route::get('/accounts-info', [UserController::class, 'getAccountsInfo']);

// Update account info
Route::put('/edit-account/{id}', [UserController::class, 'editAccount']);

// Delete account info
Route::delete('/delete-account/{id}', [UserController::class, 'deleteAccount']);

// Create product
Route::post('/add-product', [ProductController::class, 'addProduct']);