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
    	// Prodavnica iz url-a
    	//$store = Store::find($request->store);

		// $store = Route::input('store');
		// $store = Store::url();

    	// Ako prodavnica nema kategoriju iz url-a
        // dd($store);
        // dd(request()->category);
        // dd('stop');
        // dd(\App\Category::url());
        // dd($request->category);
		if(!$request->store->hasCategory($request->category)){
            //dd('problem');
			// Vrati na sve kategorije iz prodavnice
			return redirect()->route('stores.categories.index', [$request->store->slug]);

		}

        return $next($request);
    }
}
