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
        if(!$request->store->hasProduct($request->product)){
            return redirect()->route('stores.products.index', [$store->slug]);
        }

        return $next($request);
    }
}
