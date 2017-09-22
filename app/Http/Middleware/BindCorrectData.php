<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Store;
use Route;

class BindCorrectData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (starts_with(Route::current()->uri, 'shop')) {
            $this->shopBinding($request);
        } else {
            $this->ownerBinding($request);
        }

        return $next($request);
    }

    private function ownerBinding($request)
    {
        if ($request->route()->hasParameter('store')) {
            if ($request->user()) {
                $store = $request->user()->stores()->where('slug', $request->route('store')->slug)->firstOrFail();
                $request->route()->setParameter('store', $store);

                if ($request->route()->hasParameter('category')) {
                    $category = $store->categories()->where('slug', $request->route('category')->slug)->firstOrFail();
                    $request->route()->setParameter('category', $category);
                }

                if ($request->route()->hasParameter('product')) {
                    $product = $store->products()->where('slug', $request->route('product')->slug)->firstOrFail();
                    $request->route()->setParameter('product', $product);
                }

                if ($request->route()->hasParameter('order')) {
                    $order = $store->orders()->where('slug', $request->route('order')->slug)->firstOrFail();
                    $request->route()->setParameter('order', $order);
                }
            }

        }
    }

    private function shopBinding($request)
    {
        $user = $request->route('user');

        $store = $user->stores()->where('slug', $request->route('store')->slug)->firstOrFail();
        $request->route()->setParameter('store', $store);

        if ($request->route()->hasParameter('category')) {
            $category = $store->categories()->where('slug', $request->route('category')->slug)->firstOrFail();
            $request->route()->setParameter('category', $category);
        }

        if ($request->route()->hasParameter('product')) {
            $product = $store->products()->where('slug', $request->route('product')->slug)->firstOrFail();
            $request->route()->setParameter('product', $product);
        }

        if ($request->route()->hasParameter('order')) {
            $order = $store->orders()->where('slug', $request->route('order')->slug)->firstOrFail();
            $request->route()->setParameter('order', $order);
        }
    }
}
