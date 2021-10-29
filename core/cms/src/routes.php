<?php

use Carbon\Carbon;
use Cms\Controllers\BannerController;
use Cms\Controllers\CategoryController;
use Cms\Controllers\ConfigController;
use Cms\Controllers\ContactController;
use Cms\Controllers\LoginController;
use Cms\Controllers\MenuController;
use Cms\Controllers\OrderController;
use Cms\Controllers\PageController;
use Cms\Controllers\PostController;
use Cms\Controllers\ProductController;
use Cms\Controllers\TagController;
use Cms\Controllers\UserController;
use Cms\Controllers\VendorController;
use Cms\Models\ActionHistory;
use Illuminate\Http\Request;
use Illuminate\Notifications\Action;
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
            Route::post('/remove', [UserController::class, 'remove'])->name('remove');
        });

        // Category
        Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('list');
            Route::get('/search', [CategoryController::class, 'search'])->name('search');
            Route::match(['get', 'post'], '/create', [CategoryController::class, 'save'])->name('create');
            Route::match(['get', 'post'], '/edit/{category}', [CategoryController::class, 'save'])->name('edit');
            Route::post('/remove', [CategoryController::class, 'remove'])->name('remove');
        });

        // Vendor
        Route::group(['prefix' => 'vendor', 'as' => 'vendor.'], function () {
            Route::get('/', [VendorController::class, 'index'])->name('list');
            Route::get('/search', [VendorController::class, 'search'])->name('search');
            Route::match(['get', 'post'], '/create', [VendorController::class, 'save'])->name('create');
            Route::match(['get', 'post'], '/edit/{vendor}', [VendorController::class, 'save'])->name('edit');
            Route::post('/remove', [VendorController::class, 'remove'])->name('remove');
        });

        // Product
        Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
            Route::get('/', [ProductController::class, 'index'])->name('list');
            Route::get('/search', [ProductController::class, 'search'])->name('search');
            Route::match(['get', 'post'], '/create', [ProductController::class, 'save'])->name('create');
            Route::match(['get', 'post'], '/edit/{product}', [ProductController::class, 'save'])->name('edit');
            Route::post('/remove', [ProductController::class, 'remove'])->name('remove');
        });

        // Banners
        Route::group(['prefix' => 'banner', 'as' => 'banner.'], function () {
            Route::get('/', [BannerController::class, 'index'])->name('list');
            Route::get('/search', [BannerController::class, 'search'])->name('search');
            Route::match(['get', 'post'], '/create', [BannerController::class, 'save'])->name('create');
            Route::match(['get', 'post'], '/edit/{banner}', [BannerController::class, 'save'])->name('edit');
            Route::post('/remove', [BannerController::class, 'remove'])->name('remove');
            Route::match(['get', 'post'], '/center', [BannerController::class, 'center'])->name('center');
        });

        // Orders
        Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
            Route::get('/', [OrderController::class, 'index'])->name('list');
            Route::get('/search', [OrderController::class, 'search'])->name('search');
            Route::match(['get', 'post'], '/create', [OrderController::class, 'save'])->name('create');
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
            Route::post('/remove', [PostController::class, 'remove'])->name('remove');
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
            Route::post('/remove', [ContactController::class, 'remove'])->name('remove');
        });

        // Menu
        Route::group(['prefix' => 'menu', 'as' => 'menu.'], function () {
            Route::get('/', [MenuController::class, 'index'])->name('list');
            Route::get('/search', [MenuController::class, 'search'])->name('search');
            Route::match(['get', 'post'], '/create', [MenuController::class, 'save'])->name('create');
            Route::match(['get', 'post'], '/edit/{menu}', [MenuController::class, 'save'])->name('edit');
            Route::post('/update-order', [MenuController::class, 'updateOrder'])->name('updateOrder');
            Route::post('/remove', [MenuController::class, 'remove'])->name('remove');
        });

        // Tag
        Route::group(['prefix' => 'product/tag', 'as' => 'product.tag.'], function () {
            Route::get('/', [TagController::class, 'index'])->name('list');
            Route::get('/search', [TagController::class, 'search'])->name('search');
            Route::match(['get', 'post'], '/create', [TagController::class, 'saveProductTag'])->name('create');
            Route::match(['get', 'post'], '/edit/{tag}', [TagController::class, 'saveProductTag'])->name('edit');
            Route::post('/remove', [TagController::class, 'remove'])->name('remove');
        });

        Route::group(['prefix' => 'post/tag', 'as' => 'post.tag.'], function () {
            Route::get('/', [TagController::class, 'index'])->name('list');
            Route::get('/search', [TagController::class, 'search'])->name('search');
            Route::match(['get', 'post'], '/create', [TagController::class, 'savePostTag'])->name('create');
            Route::match(['get', 'post'], '/edit/{tag}', [TagController::class, 'savePostTag'])->name('edit');
            Route::post('/remove', [TagController::class, 'remove'])->name('remove');
        });

        // Run raw sql
        Route::group(['prefix' => 'sql', 'as' => 'sql.'], function () {
            Route::get('/', function () {
                return view("cms::auth.pages.sql.index");
            });

            Route::post('/', function (Request $request) {
                try {
                    $sql = $request->input('sql');
                    \DB::statement($sql);
                    return "Run SQL Done";
                } catch (\Exception $e) {
                    return $e->getMessage();
                }

            });
        });

        // Update slug
        Route::group(['prefix' => 'update-slug', 'as' => 'updateslug.'], function () {

            Route::get('/', function (Request $request) {
                $products = \Cms\Models\Product::all();
                foreach($products as $product) {
                    $product->name_url = \Illuminate\Support\Str::of($product->name)->slug('-');
                    $product->save();
                }
                return 'Done';
            });
        });

        // Check name
        Route::post('/check-duplicate-name', function (Request $request) {
            $id = $request->id;
            $name = \Illuminate\Support\Str::of($request->name)->slug('-');
            $result = false;
            $type = $request->type;
            $model = null;
            $wheres = ['name_url' => $name];
            switch($type) {
                case 'product';
                    $model = new \Cms\Models\Product();
                    break;
                case 'category':
                    $model = new \Cms\Models\Category();
                    break;
                case 'post':
                    $model = new \Cms\Models\Post();
                    break;
                case 'product_tag':
                    $model = new \Cms\Models\ProductTag();
                    break;
                case 'post_tag':
                    $model = new \Cms\Models\PostTag();
                    break;

            }
            if ($id) {
                $find = $model::query()->find($id);
                if ($find->name_url != $name) {
                    $product = $model::query()->where($wheres)->first();
                    if ($product) {
                        $result = true;
                    }
                }
            } else {
                $product = $model::query()->where($wheres)->first();
                if ($product) {
                    $result = true;
                }
            }

            return response()->json(['result' => $result], 200);
        });

        Route::get('/action-histories', function (Request $request) {
            $items = ActionHistory::query()->orderBy('created_at')->limit(20)->get();
            return view('cms::auth.pages.action_history.index', compact('items'));
        });

        // Config
        Route::group(['prefix' => 'config', 'as' => 'config.'], function () {
            Route::match(['get', 'post'], '/edit', [ConfigController::class, 'save'])->name('edit');
        });

    });
});
