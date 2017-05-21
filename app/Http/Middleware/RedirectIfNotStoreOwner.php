<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotStoreOwner
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
        // if auth user is not the owner redirect to all stores
        if (!$request->user()->isStoreOwner($request->store)) {
            return redirect()->route('stores.index');
        }

        return $next($request);
    }
}
