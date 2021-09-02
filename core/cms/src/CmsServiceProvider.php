<?php

namespace Cms;

use Cms\Middlewares\AuthCms;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class CmsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/Locale' => resource_path('lang'),
        ], 'lang');

        $this->publishes([
            __DIR__ . '/Seeders' => database_path('seeders'),
        ], 'seeder');

        //
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadRoutesFrom(__DIR__ . '/routes_api.php');
        $this->loadViewsFrom(__DIR__ . '/Views', 'cms');
        $this->loadTranslationsFrom(__DIR__ . '/Locale', 'cms');
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        $env = config('app.env');
        if ($env == 'local') {
            // \Artisan::call('vendor:publish', [
            //     '--tag' => ['public_custom_js'],
            //     '--force' => true,
            // ]);

            // DB::listen(function ($query) {
            //     \Log::info(
            //         $query->sql,
            //         $query->bindings,
            //         $query->time
            //     );
            // });
        }

        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('auth.cms', AuthCms::class);

        // $this->app->bind(
        //     \App\Exceptions\Handler::class,
        //     \Cms\Exceptions\CmsHandler::class
        // );

        $this->app->bind(
            \App\Providers\EventServiceProvider::class,
            \Cms\EventServiceProvider::class
        );

    }
}
