<?php

namespace App\Http\Middleware;

use Closure;
use App\Store;

class CheckIsCategoryInStore
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
        $store = $request->store;
        $category = $request->category;

        $belongsToStore = $store->categories()->find($category->id);

        if (!$belongsToStore) {
            return redirect()->route('stores.categories.index', [$request->store->slug]);
        }

        return $next($request);
    }
}
