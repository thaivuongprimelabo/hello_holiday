<?php

namespace Cms;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Cms\Middlewares\AuthCms;

class CmsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
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

        //
        $this->app->make('Cms\Controllers\CmsController'); 
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadViewsFrom(__DIR__.'/Views', 'cms');
        $this->loadTranslationsFrom(__DIR__ . '/Locale', 'cms');
        $this->loadMigrationsFrom(__DIR__. '/Migrations');
        

        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('auth_cms', AuthCms::class);
        
    }
}
