<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Store;
use App\Nav;
use App\BAuth;
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
        $this->shoppingData();
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

    private function shoppingData()
    {
        $views = [
            'layouts.shopping',
            'shopping.*',
            'buyer.*'
        ];
        view()->composer($views, function($view){
            $view->with('user', User::url())->with('store', Store::url());
            $view->with('BAuth', BAuth::class);
        });
    }


    // TODO: FIXME !!!!!!!! It's ugly!
    private function tmpShoppingNav()
    {
        view()->composer(['layouts.shopping', 'shopping.*'], function($view) {
            $link1 = new Nav;
            $link1->name = 'Pocetna';
            $link1->route = 'shopping.index';
            $link1->params = [User::url()->id, Store::url()->id];

            $link2 = new Nav;
            $link2->name = 'O nama';
            $link2->route = 'shopping.about';
            $link2->params = [User::url()->id, Store::url()->id];

            $link3 = new Nav;
            $link3->name = 'Kategorije';
            $link3->route = 'shopping.categories';
            $link3->params = [User::url()->id, Store::url()->id];

            // $paramLinks =[];
            $paramLinks[0] = $link1;
            $paramLinks[1] = $link2;
            $paramLinks[2] = $link3;
            $view->with('paramLinks', $paramLinks);
        });
    }
}
