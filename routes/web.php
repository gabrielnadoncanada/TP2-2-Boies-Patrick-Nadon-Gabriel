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
Route::get('/users', 'AdminController@index')->name('admin')->prefix('admin')->middleware('admin');


Route::middleware ('auth')->group (function () {
    Route::resource ('image', 'ImageController', [
        'only' => ['create', 'store', 'destroy', 'update']
    ]);
    Route::resource ('profile', 'ProfileController', [
        'only' => ['edit', 'update', 'destroy', 'show'],
        'parameters' => ['profile' => 'user']
    ]);
});

Route::post('searchResult', 'ImageController@searchResult');

Route::resource('location', 'LocationController');

Route::get('home', 'SearchController@index')->name('searchResult');
Route::get('autocomplete', 'SearchController@autocomplete')->name('autocomplete');

Route::delete('/images/{id}', 'ImageController@delete');

// Route vers la page mon profil
Route::get('profil', 'UserController@profil')->name('profil');

// Route vers la page mes images
Route::get('user_images', 'ImageController@user_images')->name('user_images');