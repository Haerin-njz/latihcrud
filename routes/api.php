<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\API\BookApiController;

Route::post('/createBook', [BookApiController::class, 'createBook']);
Route::get('/bookInfo/{id}', [BookApiController::class, 'getBook']);
Route::put('/editBook/{id}', [BookApiController::class, 'editBook']);
Route::delete('/deleteBook/{id}', [BookApiController::class, 'deleteBook']);
