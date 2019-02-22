<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfBuyerNotAuthenticated
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
        if (bauth($request->store)->check()) {
            return redirect()->route('buyer.login.show', [$request->store->slug]);
        }
        return $next($request);
    }
}
