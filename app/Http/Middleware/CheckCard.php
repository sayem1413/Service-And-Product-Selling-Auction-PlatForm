<?php

namespace App\Http\Middleware;

use Closure;

class CheckCard
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
        if(!$request->user()->can_pay){
            return redirect('/user/payment-form/');
        }
        return $next($request);
    }
}
