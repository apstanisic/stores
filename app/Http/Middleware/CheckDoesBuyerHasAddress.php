<?php

namespace App\Http\Middleware;

use Closure;

class CheckDoesBuyerHasAddress
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
        if (bauth($request->store)->user()->addresses()->count() === 0) {
            return redirect()->back();
        }
        
        return $next($request);
    }
}
