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

Route::get('imagesFlag/{id}', 'ImageController@flag');

Route::get('/', 'HomeController@index')->name('home')->middleware('verified');
// Route::get('/', 'HomeController@index')->name('home');
Route::get('/users', 'AdminController@index')->name('admin.users')->prefix('admin')->middleware('admin');

Route::get('/locations', 'AdminController@locations')->name('admin.locations')->prefix('admin')->middleware('admin');


Route::middleware ('auth')->group (function () {
    Route::resource ('image', 'ImageController', [
        'only' => ['create', 'store', 'destroy', 'update']
    ]);
    Route::resource ('user', 'UserController', [
        'only' => ['edit', 'update', 'destroy', 'show'],
        'parameters' => ['user' => 'user']
    ]);
    Route::resource ('location', 'LocationController', [
        'only' => ['create','edit', 'update', 'destroy', 'show', 'store'],
        'parameters' => ['Location' => 'Location']
    ]);
});

Route::post('searchResult', 'ImageController@searchResult');



Route::get('home', 'SearchController@index')->name('searchResult');
Route::get('autocomplete', 'SearchController@autocomplete')->name('autocomplete');

Route::delete('/images/{id}', 'ImageController@delete');

Route::get('/user/{id}/edit', 'UserController@edit')->name('user_edit');
Route::get('/user/{id}/images', 'ImageController@user_images')->name('user_images');
Route::get('/user/{id}/destroy', 'UserController@destroy')->name('user_destroy');
Route::get('/location/{id}/destroy', 'LocationController@destroy')->name('location_destroy');