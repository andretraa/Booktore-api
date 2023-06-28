<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::prefix('v1')->group(function (){

//     Route::get('books', [BookController::class, 'index']);
//     Route::get('books/{id}', [BookController::class, 'show']);
//     Route::get('books/top/{count}', [BookController::class, 'top']);
   
//     Route::get('categories/random/{count}', [CategoryController::class, 'random']);
    
// });


