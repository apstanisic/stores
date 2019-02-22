<?php

namespace App\Http\Middleware;

use Closure;
use App\Store;

class CheckDoesStoreBelongsToUser
{
    /**
     * Handle an incoming request.
     * If logged user is not the owner redirect to Stores page
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $store = $request->store;
        // dd($store);
        
        if (!auth()->user()->id === $store->user->id) {
            return redirect()->route('stores.index');
        }
        
        return $next($request);
    }
}
