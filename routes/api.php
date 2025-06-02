<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::post('/createBook', [BookController::class, 'createBook']);
Route::get('/getBook/{id}', [BookController::class, 'getBook']);
Route::put('/editBook/{id}', [BookController::class, 'editBook']);
Route::delete('/deleteBook/{id}', [BookController::class, 'deleteBook']);
