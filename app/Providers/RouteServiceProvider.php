<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapShopRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }


    /**
     * Define the "shop" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     * These routes are for buyer facing pages.
     *
     * @return void
     */
    protected function mapShopRoutes()
    {
        Route::middleware('web')
             ->prefix('s')
             ->namespace($this->namespace . '\Shop')
             ->group(base_path('routes/shop.php'));
    }

    // /**
    //  * Get correct store from url, because of non unique slug
    //  *
    //  * @return \App\Store
    //  */
    // private function bindCorrectData()
    // {
    //     Route::bind('store', function() {
    //         $storeSlug = request()->route()->store;
            
    //         if (request()->route()->hasParameter('user')) {
    //             $userSlug = request()->route()->user;
    //         } else {
    //             $userSlug = auth()->user()->slug;
    //         }

    //     return \App\Store::findBySlug($storeSlug, $userSlug)->firstOrFail();
            

    //         // $store = \App\Store::where('slug', request()->route()->store)->whereHas('user', function($query) {
    //         //     $query->where('slug', request()->route()->user);
    //         // })->firstOrFail();
    //         // Store::findBySlug()

    // });

    // }
    

}