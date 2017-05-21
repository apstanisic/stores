<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfOrderProcessed
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
        if (!$request->order->canEdit()) {
            session()->flash('flash_danger', 'Nisu moguce izmene na porudzbini');
            return redirect()->back();
        }

        return $next($request);
    }
}
