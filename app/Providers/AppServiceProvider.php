<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
// TODO Skinuti na novom mysql
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // TODO // Skinuti kada se stavi nova verzija mysql-a
        Schema::defaultStringLength(191);

        Validator::extend('check_password', function($attribute, $value, $parameters, $validator) {
            return \Hash::check($value, current($parameters));
        }, 'Old password is invalid');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
