<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Store;
use Route;


class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    	$this->getStoreFromRoute();

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

    // All routes that needs store object should be listed here.
    // That way you don't have to send store object with view
    // every time you call that view, just add needed views.
    private function getStoreFromRoute() 
    {
    	// Witch views should be able to access the store 
    	$views = [
    		'layouts.dashboard',
    		'categories.*',
    		'products.*'
    	];

        view()->composer($views, function($view) {
        	$view->with('store', Store::findOrFail(Route::input('store')));
        });
    }
}
