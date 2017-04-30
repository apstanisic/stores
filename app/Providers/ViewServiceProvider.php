<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Store;
use App\Nav;
use App\User;
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
        $this->getNav();
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

		// Ako se prosledjuje id
		// Store::findOrFail(Route::input('store'))
        view()->composer($views, function($view) {
        	$view->with('store', Store::url());
        });
    }

    private function getNav()
    {
        view()->composer('layouts.master', function($view) {
            $view->with('links', Nav::links()->get());
        });

        $this->tmpShoppingNav();

    }


    // TODO: FIXME !!!!!!!! It's ugly!
    private function tmpShoppingNav()
    {
        view()->composer('layouts.shopping', function($view) {
            $link = new Nav;
            $link->name = 'Kategorije';
            $link->route = 'shopping.categories';
            $link->params = [Route::input('user')->id, Store::url()->id];

            $link2 = new Nav;
            $link2->name = 'O nama';
            $link2->route = 'shopping.about';
            $link2->params = [Route::input('user')->id, Store::url()->id];

            // $paramLinks =[];
            $paramLinks[0] = $link;
            $paramLinks[1] = $link2;
            $view->with('paramLinks', $paramLinks);
        });
    }
}
