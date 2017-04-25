<?php

namespace App\Http\Middleware;

use Closure;
use App\Store;

class RedirectIfProductNotInStore
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

        $store = Store::url();

        if(!$store->hasProduct($request->product)){

            // Vrati na sve kategorije iz prodavnice
            return redirect()->route('stores.index');

        }

        return $next($request);
    }
}
