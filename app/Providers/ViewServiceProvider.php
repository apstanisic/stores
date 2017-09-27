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
        // $this->getBAuth();
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
    private function getStoreFromRoute()
    {
    	$views = [
    		'layouts.dashboard',
            'layouts.shopping',

            'partials.products.ownerMany',

    		'categories.create',
            'categories.index',
    		'products.create',

            'shopping.*',
            '*'
    	];

        view()->composer($views, function($view) {
        	$view->with('store', Store::url());
        });
    }

    private function getNav()
    {
        // view()->composer('layouts.master', function($view) {
        //     $view->with('links', Nav::links()->get());
        // });

        $this->tmpShoppingNav();

    }

    // private function getBAuth()
    // {
    //     $views = [
    //         '*'
    //     ];

    //     view()->composer($views, function($view){
    //         $view->with('BAuth', BAuth::class);
    //     });
    // }


    // TODO: Pretify
    private function tmpShoppingNav()
    {
        view()->composer(['layouts.shopping', 'shopping.*'], function($view) {
            $link1 = new Nav;
            $link1->name = 'Početna';
            $link1->route = 'shopping.index';
            $link1->params = [User::url()->slug, Store::url()->slug];

            $link2 = new Nav;
            $link2->name = 'O nama';
            $link2->route = 'shopping.about';
            $link2->params = [User::url()->slug, Store::url()->slug];

            $link3 = new Nav;
            $link3->name = 'Kategorije';
            $link3->route = 'shopping.categories.index';
            $link3->params = [User::url()->slug, Store::url()->slug];

            // $paramLinks =[];
            $paramLinks[0] = $link1;
            $paramLinks[1] = $link2;
            $paramLinks[2] = $link3;
            $view->with('paramLinks', $paramLinks);
        });
    }

}
