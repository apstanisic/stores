<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $views = [
            // 'stores.show'
    		// 'layouts.dashboard',
            // 'layouts.shopping',

            // 'partials.products.ownerMany',

    		// 'categories.create',
            // 'categories.index',
    		// 'products.create',

            // 'shopping.*',
            '*'
    	];
        view()->composer('*', function($view) {
        	$view->with('store', \App\Store::fromUrl());
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
