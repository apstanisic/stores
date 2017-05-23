<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfBuyerDontHaveAddress
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
        if (!bauth($request->store)->user()->hasAddress()) {
            session()->flash('flash_danger', 'Morate imati adresu da biste narucili');
            return redirect()->back();
        }

        return $next($request);
    }
}
