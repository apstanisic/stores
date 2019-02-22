<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfBuyerAuthenticated
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
        if (bauth($request->store)->guest()) {
            return redirect()->route('shop.index', [$request->store->slug]);
        }
        return $next($request);
    }
}
