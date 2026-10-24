<?php

namespace TradeInTradeUp\Http\Middleware;

use Closure;
use Auth;

class Admin
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
        // if (Auth::check() && Auth::user()->role == '1' || Auth::check() && Auth::user()->role == '2') {
        //     return $next($request);
        // }
        // else {
        //     Auth::logout();
        //     return redirect('/login');
        // }
    }
}
