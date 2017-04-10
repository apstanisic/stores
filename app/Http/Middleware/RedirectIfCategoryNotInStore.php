<?php

namespace App\Http\Middleware;

use Closure;
use App\Store;

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

    	// Prodavnica iz url-a
    	$store = Store::find($request->store);

    	// Ako prodavnica nema kategoriju iz url-a
		if(!$store->hasCategory($request->category)){

			// Vrati na sve kategorije iz prodavnice
			return redirect()->route('categories.index', [$store->id]);

		}

        return $next($request);
    }
}
