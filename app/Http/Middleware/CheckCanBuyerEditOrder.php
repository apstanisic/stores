<?php

namespace App\Http\Middleware;

use Closure;

class CheckCanBuyerEditOrder
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
        $order = $this->order;

        if (!$order->status->name === 'processing' && !$order->status->name === 'paused') {
            return redirect()->back();
        }
        
        return $next($request);
    }
}
