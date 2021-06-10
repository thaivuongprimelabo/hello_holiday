<?php
namespace Web;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Cms\Middlewares\AuthCms;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class WebServiceProvider extends ServiceProvider
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
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        
    }
}