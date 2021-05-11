<?php
use Illuminate\Support\Facades\Route;


use Cms\Controllers\LoginController;
use Cms\Controllers\CmsController;
use Cms\Controllers\UserController;
use Cms\Controllers\CategoryController;

Route::group(['prefix' => 'auth', 'as' => 'auth.', 'middleware' => 'web'], function () {
    Route::match(['get', 'post'], '/login',  [LoginController::class, 'index'])->name('login');
    Route::match(['get', 'post'], '/logout',  [LoginController::class, 'logout'])->name('logout');

    Route::group(['middleware' => 'auth.cms'], function() {
        Route::get('/',  [CmsController::class, 'index'])->name('index');
        Route::get('/dashboard',  [CmsController::class, 'index'])->name('dashboard');

        // Users
        Route::group(['prefix' => 'user', 'as' => 'user.'], function() {
            Route::get('/',  [UserController::class, 'index'])->name('list');
            Route::get('/search',  [UserController::class, 'search'])->name('search');
            Route::match(['get', 'post'], '/create',  [UserController::class, 'save'])->name('create');
            Route::match(['get', 'post'], '/edit/{user}',  [UserController::class, 'save'])->name('edit');
            Route::post('/remove}',  [UserController::class, 'remove'])->name('remove');
            Route::post('/restore}',  [UserController::class, 'restore'])->name('restore');
        });

        // Category
        Route::group(['prefix' => 'category', 'as' => 'user.'], function() {
            Route::get('/',  'CategoryController@index')->name('list');
            Route::get('/search',  'CategoryController@search')->name('search');
            Route::match(['get', 'post'], '/create',  'UserController@save')->name('create');
            Route::match(['get', 'post'], '/edit/{user}',  'UserController@save')->name('edit');
            Route::post('/remove}',  'CategoryController@remove')->name('remove');
            Route::post('/restore}',  'CategoryController@restore')->name('restore');
        });
        
    });
});

