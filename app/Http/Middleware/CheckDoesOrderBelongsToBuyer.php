<?php

namespace App\Http\Middleware;

use Closure;

class CheckDoesOrderBelongsToBuyer
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
        $hasOrder = bauth($request->store)->user()->orders()->find($request->order->id);

        if (!$hasOrder) {
            return redirect()->back();
        }

        return $next($request);
    }
}
