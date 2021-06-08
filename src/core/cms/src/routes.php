<?php
use Illuminate\Support\Facades\Route;


use Cms\Controllers\LoginController;
use Cms\Controllers\CmsController;
use Cms\Controllers\UserController;
use Cms\Controllers\CategoryController;
use Cms\Controllers\VendorController;

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
        });

        // Category
        Route::group(['prefix' => 'category', 'as' => 'category.'], function() {
            Route::get('/',  [CategoryController::class, 'index'])->name('list');
            Route::get('/search',  [CategoryController::class, 'search'])->name('search');
            Route::match(['get', 'post'], '/create',  [CategoryController::class, 'save'])->name('create');
            Route::match(['get', 'post'], '/edit/{category}',  [CategoryController::class, 'save'])->name('edit');
            Route::post('/remove}',  [CategoryController::class, 'remove'])->name('remove');
        });

        // Vendor
        Route::group(['prefix' => 'vendor', 'as' => 'vendor.'], function() {
            Route::get('/',  [VendorController::class, 'index'])->name('list');
            Route::get('/search',  [VendorController::class, 'search'])->name('search');
            Route::match(['get', 'post'], '/create',  [VendorController::class, 'save'])->name('create');
            Route::match(['get', 'post'], '/edit/{vendor}',  [VendorController::class, 'save'])->name('edit');
            Route::post('/remove}',  [VendorController::class, 'remove'])->name('remove');
        });

        // Product
        Route::group(['prefix' => 'product', 'as' => 'product.'], function() {
            Route::get('/',  [VendorController::class, 'index'])->name('list');
            Route::get('/search',  [VendorController::class, 'search'])->name('search');
            Route::match(['get', 'post'], '/create',  [VendorController::class, 'save'])->name('create');
            Route::match(['get', 'post'], '/edit/{vendor}',  [VendorController::class, 'save'])->name('edit');
            Route::post('/remove}',  [VendorController::class, 'remove'])->name('remove');
        });
        
    });
});

