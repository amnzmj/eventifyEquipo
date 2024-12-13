<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminUser
{
    /**
     * Maneja una solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica si el usuario está autenticado y es el administrador especificado
        if (Auth::check() && Auth::user()->email === 'pba1@gmail.com') {
            return $next($request);
        }

        // Si no es el usuario administrador, redirige a otra página
        return redirect('/public-events')->with('error', 'No tienes permiso para acceder a esta página.');
    }
}
