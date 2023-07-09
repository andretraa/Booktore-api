<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Book;
use App\Http\Resource\Book as BookResource;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;

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
    
    Route::get('books', [BookController::class, 'index']);
    Route::get('books/{id}', [BookController::class, 'show']);
    Route::get('books/top/{count}', [BookController::class, 'top']);
    Route::get('books/slug/{slug}', [BookController::class, 'slug']);
    Route::get('books/search/{keyword}', [BookController::class, 'search']);
    
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categories/random/{count}', [CategoryController::class, 'random']);
    Route::get('categories/slug/{slug}', [CategoryController::class, 'slug']);
});
