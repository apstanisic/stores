<?php

namespace App\Http\Middleware;

use Closure;
use App\BAuth;
use App\Store;

class RedirectIfBuyerLoged
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

        if (BAuth::check(Store::url())) {
            return redirect()->route('shopping.index', [Store::url()->user->id, Store::url()->id]);
        }
        return $next($request);
    }
}
