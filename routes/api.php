<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Api\LoginController;
use App\Http\Controllers\Auth\Api\RegisterController;
use App\Domain\BookStore\Controllers\BookStoreController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->group(function () {

    Route::get('/user', [LoginController::class, 'user'])->middleware('auth:sanctum');

    Route::post('/login', [LoginController::class, 'login']);

    Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

    Route::post('/register', [RegisterController::class, 'reg']);
});

Route::middleware('auth:sanctum')->group(function () {

    /* Book Store */
    Route::get('/list-book', [BookStoreController::class, 'index']);

    Route::post('/create-book', [BookStoreController::class, 'store']);

    Route::put('/update-book/{book_id}', [BookStoreController::class, 'update']);

    Route::delete('/delete-book/{book_id}', [BookStoreController::class, 'destroy']);
});
