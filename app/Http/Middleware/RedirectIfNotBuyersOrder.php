<?php

namespace App\Http\Middleware;

use Closure;
use App\BAuth;

class RedirectIfNotBuyersOrder
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
        if (!BAuth::buyer($request->store)->hasOrder($request->order)) {
            return redirect()->back();
        }
        return $next($request);
    }
}
