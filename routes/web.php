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

Route::group(['as'=>'admin.','prefix'=>'adminpanel','namespace'=>'Admin'], function(){

    Route::get('login','Auth\LoginController@index')->name('login');
    Route::post('login','Auth\LoginController@login')->name('process-login');
    Route::get('logout','Auth\LoginController@logout')->name('logout');
    
    Route::group(['middleware'=>'auth'], function(){
        Route::get('/', 'HomeController@index')->name('home');

        Route::group(['as'=>'profile.','prefix'=>'profile'], function(){
            Route::get('/', 'ProfileController@index')->name('index');
            Route::get('create', 'ProfileController@create')->name('create');
            Route::post('store', 'ProfileController@store')->name('store');
            Route::get('edit', 'ProfileController@edit')->name('edit');
            Route::post('update', 'ProfileController@update')->name('update');
        });

        Route::group(['as'=>'album.','prefix'=>'album'], function(){
            Route::get('/', 'AlbumController@index')->name('index');
            Route::get('create', 'AlbumController@create')->name('create');
            Route::post('store', 'AlbumController@store')->name('store');
            Route::get('{id}/show', 'AlbumController@show')->name('show');
            Route::get('{id}/edit', 'AlbumController@edit')->name('edit');
            Route::put('{id}/update', 'AlbumController@update')->name('update');
            Route::delete('{id}/destroy', 'AlbumController@destroy')->name('destroy');
            Route::get('get-image-gallery/{id}', 'AlbumController@getImageGallery')->name('get-image');
            Route::post('upload-image/{id}', 'AlbumController@uploadImage')->name('upload-image');
            Route::delete('delete-image/{id}', 'AlbumController@deleteImage')->name('delete-image');
        });
    });
});