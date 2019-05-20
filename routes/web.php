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


// AdminController
Route::middleware ('admin')->group (function () {
    Route::prefix('admin')->group(function () {
        Route::name('admin.')->group(function () {
            Route::get('/users', 'AdminController@users')->name('users');
            Route::get('/locations', 'AdminController@locations')->name('locations');
            Route::get('/reported', 'AdminController@reported')->name('reported');
            Route::delete('/undo/{id}', 'AdminController@undo')->name('undo');
            Route::put('/user/{id}', 'UserController@update');
            Route::delete('/delete', 'AdminController@destroyMany')->name('destroyMany');
        });
    });
});


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

Route::get('/', 'HomeController@index')->name('home')->middleware('verified');
Route::get('home', 'SearchController@index')->name('searchResult');
Route::get('autocomplete', 'SearchController@autocomplete')->name('autocomplete');
Route::get('imagesFlag/{id}', 'ImageController@flag');
Route::delete('/images/{id}', 'ImageController@delete');
Route::post('searchResult', 'ImageController@searchResult');
Route::get('/user/{id}/images', 'ImageController@user_images')->name('user_images');
Route::delete('/user/{id}/destroy', 'UserController@destroy')->name('user_destroy');

Route::get('/user/{id}/edit', 'UserController@edit')->name('user_edit');
Route::get('/location/{id}/destroy', 'LocationController@destroy')->name('location_destroy');