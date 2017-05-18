<?php

namespace App\Http\Middleware;

use Closure;
use App\BAuth;
use App\Store;

class RedirectIfBuyerNotLoged
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
        if (BAuth::guest()) {
            session()->flash('flash_danger', 'Morate biti ulogovani');
            return redirect()->route('buyer.login.show', [$request->store->user->slug, $request->store->slug]);
        }

        return $next($request);
    }
}
