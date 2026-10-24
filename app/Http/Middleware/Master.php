<?php

namespace TradeInTradeUp\Http\Middleware;

use Closure;
use Auth;

class Master
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
        if (Auth::check()) {
            if(Auth::user()->role == 2){
                return $next($request);
            }
            else {
                return "Forbidden.";
            }
        }
    }
}
