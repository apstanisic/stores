<?php

namespace App\Http\Middleware;

use Closure;
use App\Store;
use Route;

class RedirectIfCategoryNotInStore
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
		if(!$request->store->hasCategory($request->category)){
			return redirect()->route('stores.categories.index', [$request->store->slug]);
		}

        return $next($request);
    }
}
