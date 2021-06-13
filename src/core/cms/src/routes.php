<?php
use Cms\Controllers\BannerController;
use Cms\Controllers\CategoryController;
use Cms\Controllers\ConfigController;
use Cms\Controllers\LoginController;
use Cms\Controllers\OrderController;
use Cms\Controllers\PageController;
use Cms\Controllers\PostController;
use Cms\Controllers\ProductController;
use Cms\Controllers\UserController;
use Cms\Controllers\VendorController;
use Cms\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'as' => 'auth.', 'middleware' => 'web'], function () {
    Route::match(['get', 'post'], '/login', [LoginController::class, 'index'])->name('login');
    Route::match(['get', 'post'], '/logout', [LoginController::class, 'logout'])->name('logout');

    Route::group(['middleware' => 'auth.cms'], function () {

        Route::get('/', function () {
            return redirect()->route('auth.product.list');
        })->name('index');

        Route::get('/dashboard', function () {
            return redirect()->route('auth.product.list');
        })->name('dashboard');

        // Users
        Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
            Route::get('/', [UserController::class, 'index'])->name('list');
            Route::get('/search', [UserController::class, 'search'])->name('search');
            Route::match(['get', 'post'], '/create', [UserController::class, 'save'])->name('create');
            Route::match(['get', 'post'], '/edit/{user}', [UserController::class, 'save'])->name('edit');
            Route::post('/remove}', [UserController::class, 'remove'])->name('remove');
        });

        // Category
        Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('list');
            Route::get('/search', [CategoryController::class, 'search'])->name('search');
            Route::match(['get', 'post'], '/create', [CategoryController::class, 'save'])->name('create');
            Route::match(['get', 'post'], '/edit/{category}', [CategoryController::class, 'save'])->name('edit');
            Route::post('/remove}', [CategoryController::class, 'remove'])->name('remove');
        });

        // Vendor
        Route::group(['prefix' => 'vendor', 'as' => 'vendor.'], function () {
            Route::get('/', [VendorController::class, 'index'])->name('list');
            Route::get('/search', [VendorController::class, 'search'])->name('search');
            Route::match(['get', 'post'], '/create', [VendorController::class, 'save'])->name('create');
            Route::match(['get', 'post'], '/edit/{vendor}', [VendorController::class, 'save'])->name('edit');
            Route::post('/remove}', [VendorController::class, 'remove'])->name('remove');
        });

        // Product
        Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
            Route::get('/', [ProductController::class, 'index'])->name('list');
            Route::get('/search', [ProductController::class, 'search'])->name('search');
            Route::match(['get', 'post'], '/create', [ProductController::class, 'save'])->name('create');
            Route::match(['get', 'post'], '/edit/{product}', [ProductController::class, 'save'])->name('edit');
            Route::post('/remove}', [ProductController::class, 'remove'])->name('remove');
        });

        // Banners
        Route::group(['prefix' => 'banner', 'as' => 'banner.'], function () {
            Route::get('/', [BannerController::class, 'index'])->name('list');
            Route::get('/search', [BannerController::class, 'search'])->name('search');
            Route::match(['get', 'post'], '/create', [BannerController::class, 'save'])->name('create');
            Route::match(['get', 'post'], '/edit/{banner}', [BannerController::class, 'save'])->name('edit');
            Route::post('/remove}', [BannerController::class, 'remove'])->name('remove');
        });

        // Orders
        Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
            Route::get('/', [OrderController::class, 'index'])->name('list');
            Route::get('/search', [OrderController::class, 'search'])->name('search');
            Route::match(['get', 'post'], '/edit/{order}', [OrderController::class, 'save'])->name('edit');
            Route::post('/remove', [OrderController::class, 'remove'])->name('remove');
            Route::get('/print/{order}', [OrderController::class, 'print'])->name('print');

        });

        // Post
        Route::group(['prefix' => 'post', 'as' => 'post.'], function () {
            Route::get('/', [PostController::class, 'index'])->name('list');
            Route::get('/search', [PostController::class, 'search'])->name('search');
            Route::match(['get', 'post'], '/create', [PostController::class, 'save'])->name('create');
            Route::match(['get', 'post'], '/edit/{post}', [PostController::class, 'save'])->name('edit');
            Route::post('/remove}', [PostController::class, 'remove'])->name('remove');
        });

        // Page
        Route::group(['prefix' => 'page', 'as' => 'page.'], function () {
            Route::get('/', [PageController::class, 'index'])->name('list');
            Route::get('/search', [PageController::class, 'search'])->name('search');
            Route::match(['get', 'post'], '/edit/{page}', [PageController::class, 'save'])->name('edit');
        });

        // Contact
        Route::group(['prefix' => 'contact', 'as' => 'contact.'], function () {
            Route::get('/', [ContactController::class, 'index'])->name('list');
            Route::get('/search', [ContactController::class, 'search'])->name('search');
            Route::match(['get', 'post'], '/edit/{contact}', [ContactController::class, 'save'])->name('edit');
        });

        // Config
        Route::group(['prefix' => 'config', 'as' => 'config.'], function () {
            Route::match(['get', 'post'], '/edit', [ConfigController::class, 'save'])->name('edit');
        });

    });
});
