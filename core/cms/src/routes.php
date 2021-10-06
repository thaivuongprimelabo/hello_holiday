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
use Symfony\Component\HttpFoundation\StreamedResponse;


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
            Route::post('/remove}', [ContactController::class, 'remove'])->name('remove');
        });

        // Config
        Route::group(['prefix' => 'config', 'as' => 'config.'], function () {
            Route::match(['get', 'post'], '/edit', [ConfigController::class, 'save'])->name('edit');
        });

        Route::get('export', function () {
            // $response = new StreamedResponse(function () {
            //     // Open output stream
            //     $handle = fopen('php://output', 'w');

            //     // Add CSV headers
            //     fputcsv($handle, [
            //         'id',
            //         'name',
            //         'email',
            //     ]);

            //     // Get products
            //     // foreach (\App\Models\Testing::all() as $product) {
            //     //     // Add a new row with data
            //     //     fputcsv($handle, [
            //     //         $product->id,
            //     //         $product->name,
            //     //     ]);
            //     // }

            //     \App\Models\Testing::chunk(5, function ($products) use ($handle) {
            //         foreach ($products as $product) {
            //             // Add a new row with data
            //             fputcsv($handle, [
            //                 $product->id,
            //                 $product->name,
            //                 $product->email,
            //             ]);
            //         }
            //     });


            //     // Close the output stream
            //     fclose($handle);
            // }, 200, [
            //     'Content-Type' => 'text/csv',
            //     'Content-Disposition' => 'attachment; filename="export.csv"',
            // ]);

            ini_set('display_errors', 1);
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);


            $result = \Cms\Models\Testing::query()->limit(100000)->get()->toArray();

            echo 'ok';
            exit;

            $arr_item = array(
                'id',
                'name',
            );

            foreach( $arr_item as $elem )
                $csv_data .= $elem . ',';
                $csv_data = rtrim( $csv_data, ',' ) . "\n";

            // CSVデータの作成（データ部）
            for( $i = 0; $i < count5x( $result ); $i++ ) {
                $csv_data .= $result[ $i ][ 'id' ] . ','
                    . $result[ $i ][ 'name' ] . "\n";
            }

            // CSVファイル名の設定
            $csv_file = 'product.csv';

            // データの文字コード変更
            $csv_data = mb_convert_encoding($csv_data, CHAR_CSV, CHAR_DB);

            // MIMEタイプの設定
            header('Content-Type: application/octet-stream');

            // ファイル名の表示
            header('Content-Disposition: attachment; filename=' . $csv_file);

            // データの出力
            print $csv_data;
            exit;



            return $response;
        });


    });
});
