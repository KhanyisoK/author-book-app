<?php

use Illuminate\Support\Facades\Route;

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
Route::resource('author', \App\Http\Controllers\AuthorController::class);
Route::resource('book', \App\Http\Controllers\BookController::class);
//delete author
Route::get('delete-author/{id}', '\App\Http\Controllers\AuthorController@destroy');
//delete book
Route::get('delete-books/{id}', '\App\Http\Controllers\BookController@destroy');
Route::get('create-co-author/{id}', '\App\Http\Controllers\BookController@addCoAuthor');
Route::post('store-co-author', '\App\Http\Controllers\BookController@storeCoAuthor')->name('store-co-author');
