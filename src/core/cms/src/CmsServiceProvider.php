<?php

namespace Cms;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Cms\Middlewares\AuthCms;
use Illuminate\Support\Facades\Artisan;

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
            __DIR__.'/Assets' => public_path('cms'),
        ], 'public');

        $this->publishes([
            __DIR__.'/Locale' => resource_path('lang'),
        ], 'lang');

        $this->publishes([
            __DIR__.'/Seeders' => database_path('seeders'),
        ], 'seeder');

        //
        $this->app->make('Cms\Controllers\CmsController'); 
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadViewsFrom(__DIR__.'/Views', 'cms');
        $this->loadTranslationsFrom(__DIR__ . '/Locale', 'cms');
        $this->loadMigrationsFrom(__DIR__. '/Migrations');
        
        $env = config('app.env');
        if($env == 'local') {
            Artisan::call('vendor:publish', [
                '--tag' => ['public', 'lang', 'seeder'], 
                '--force' => true,
            ]);
        }

        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('auth.cms', AuthCms::class);
        
    }
}
