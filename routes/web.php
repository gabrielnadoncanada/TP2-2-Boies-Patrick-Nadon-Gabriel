<?php

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
    return view('home');
});

Auth::routes();

Auth::routes(['verify' => true]);

Route::put('imagesFlag/{id}', 'ImageController@flag');

Route::get('/', 'HomeController@index')->name('home')->middleware('verified');
// Route::get('/', 'HomeController@index')->name('home');
Route::get('/users', 'AdminController@index')->name('admin')->prefix('admin')->middleware('admin');


Route::middleware ('auth')->group (function () {
    Route::resource ('image', 'ImageController', [
        'only' => ['create', 'store', 'destroy', 'update']
    ]);
});

Route::post('searchResult', 'ImageController@searchResult');

Route::resource('location', 'LocationController');

Route::get('home', 'SearchController@index')->name('searchResult');
Route::get('autocomplete', 'SearchController@autocomplete')->name('autocomplete');

Route::delete('/images/{id}', 'ImageController@delete');