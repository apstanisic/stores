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
        if (!BAuth::buyer()->hasOrder($request->order)) {
            // session()->flash('flash_danger', )
            return redirect()->back();
        }
        return $next($request);
    }
}
