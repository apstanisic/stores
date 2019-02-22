<?php

namespace App\Http\Middleware;

use Closure;

class CheckIsProductInStore
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
        $store = $request->store;
        $product = $request->product;

        $belongsToStore = $store->products()->find($product->id);

        if (!$belongsToStore) {
            return redirect()->route('stores.products.index', [$store->slug]);
        }

        return $next($request);
    }
}
