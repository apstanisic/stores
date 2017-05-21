<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfOrderNotInStore
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
        if (!$request->store->hasOrder($request->order)) {
            return redirect()->back();
        }

        return $next($request);
    }
}
