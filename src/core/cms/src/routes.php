<?php
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'auth', 'as' => 'auth.', 'middleware' => 'web'], function () {
    Route::match(['get', 'post'], '/login',  'Cms\Controllers\LoginController@index')->name('login');
    Route::match(['get', 'post'], '/logout',  'Cms\Controllers\LoginController@logout')->name('logout');

    Route::group(['middleware' => 'auth.cms'], function() {
        Route::get('/',  'Cms\Controllers\CmsController@index')->name('index');
        Route::get('/dashboard',  'Cms\Controllers\CmsController@index')->name('dashboard');

        // Users
        Route::group(['prefix' => 'user', 'as' => 'user.'], function() {
            Route::get('/',  'Cms\Controllers\UserController@index')->name('list');
            Route::get('/search',  'Cms\Controllers\UserController@search')->name('search');
            Route::match(['get', 'post'], '/create',  'Cms\Controllers\UserController@save')->name('create');
            Route::match(['get', 'post'], '/edit/{user}',  'Cms\Controllers\UserController@save')->name('edit');
            Route::post('/remove}',  'Cms\Controllers\UserController@remove')->name('remove');
            Route::post('/restore}',  'Cms\Controllers\UserController@restore')->name('restore');
        });
        
    });
});

