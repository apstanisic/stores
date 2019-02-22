<?php

namespace App\Http\Middleware;

use Closure;

class CheckIsOrderInStore
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

        $belongsToStore = $store->orders()->find($request->order->id);

        if (!$belongsToStore) {
            return redirect()->back();
        }

        return $next($request);
    }
}
