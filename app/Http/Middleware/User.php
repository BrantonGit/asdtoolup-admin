<?php

namespace TradeInTradeUp\Http\Middleware;

use Closure;
use Auth;

class User
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
            if(Auth::user()->role == 0){
                return "Forbidden";
            }
        }
    }
}
