<?php
use Illuminate\Support\Facades\Route;
use Web\Controllers\CartController;
use Web\Controllers\HomeController;
use Web\Controllers\PageController;
use Web\Controllers\ProductController;
use Web\Controllers\ContactController;
use Web\Controllers\PostController;

Route::group(['middleware' => 'web'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('about', [PageController::class, 'about'])->name('page.about');
    Route::get('shopping-guide', [PageController::class, 'shopping'])->name('page.shopping');
    Route::get('warranty', [PageController::class, 'warranty'])->name('page.warranty');
    Route::get('delivery', [PageController::class, 'delivery'])->name('page.delivery');
    Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
    Route::get('news', [PostController::class, 'index'])->name('post.index');

    Route::group(['as' => 'product.'], function () {
        Route::get('category/{slug}', [ProductController::class, 'productsByCategory'])->name('productsByCategory');
        Route::get('category/{slug}/{child_slug}', [ProductController::class, 'productsByChildCategory'])->name('productsByChildCategory');
        Route::get('product/{slug}', [ProductController::class, 'detail'])->name('detail');
        Route::get('products', [ProductController::class, 'index'])->name('index');
        Route::get('products/search', [ProductController::class, 'search'])->name('search');
        Route::post('get-products', [ProductController::class, 'getProducts'])->name('getProducts');
    });

    Route::group(['as' => 'post.'], function () {
        Route::get('/post/{slug}', [PostController::class, 'detail'])->name('detail');
        Route::get('/posts', [PostController::class, 'index'])->name('index');
        Route::get('/get-posts', [PostController::class, 'getPosts'])->name('getPosts');

    });

    Route::match(['get', 'post'], '/contact', [ContactController::class, 'index'])->name('contact.index');

    Route::group(['prefix' => 'cart', 'as' => 'cart.'], function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::get('/cart-top', [CartController::class, 'cartTop'])->name('cartTop');
        Route::post('/add-item', [CartController::class, 'addItem'])->name('addItem');
        Route::post('/remove-item', [CartController::class, 'removeItem'])->name('removeItem');
        Route::post('/update', [CartController::class, 'update'])->name('update');
        Route::post('/destroy', [CartController::class, 'destroy'])->name('destroy');
        Route::match(['get', 'post'], '/checkout', [CartController::class, 'checkout'])->name('checkout');
        Route::get('/checkout/success', [CartController::class, 'checkoutSuccess'])->name('checkoutSuccess');
    });

});

Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');
    return 'Config cache cleared ' . $exitCode;
})->name("config.cache");




