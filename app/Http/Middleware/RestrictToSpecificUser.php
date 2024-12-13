<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RestrictToSpecificUser
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
        if (Auth::user() && Auth::user()->email === 'pba1@gmail.com') {
            return $next($request);
        }

        return redirect('/public-events')->with('error', 'No tienes acceso a esta sección.');
    }
}
