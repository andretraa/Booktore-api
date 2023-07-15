<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Book;
use App\Http\Resource\Book as BookResource;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;

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



Route::prefix('v1')->group(function (){

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout',[AuthController::class,'logout']);
        Route::post('shipping', [ShopController::class, 'shipping']);
        Route::post('services', [ShopController::class, 'services']);
        Route::post('payment', [ShopController::class, 'payment']);
        Route::get('my-order', [ShopController::class, 'myOrder']);
    });

    Route::get('books', [BookController::class, 'index']);
    Route::get('books/{id}', [BookController::class, 'show']);
    Route::get('books/top/{count}', [BookController::class, 'top']);
    Route::get('books/slug/{slug}', [BookController::class, 'slug']);
    Route::get('books/search/{keyword}', [BookController::class, 'search']);
    
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categories/random/{count}', [CategoryController::class, 'random']);
    Route::get('categories/slug/{slug}', [CategoryController::class, 'slug']);

    Route::get('provinces', [ShopController::class, 'provinces']);
    Route::get('cities', [ShopController::class, 'cities']);
    Route::get('couriers', [ShopController::class, 'couriers']);
});
