<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use Auth;
use App\Store;

class RedirectIfNotTheOwner
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

        // TODO : verovatno ima lepsi nacin da se uzme input
        // Ako nije vlasnik prodavnice vrati ga na sve prodavnice
        if(!$request->user()->isStoreOwner(Route::input('store'))){
            return redirect()->route('stores.index');
        }

        return $next($request);
    }
}
