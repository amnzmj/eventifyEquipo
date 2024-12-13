<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContentSecurityPolicyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $response->headers->set('Content-Security-Policy', "script-src 'self' https://js.stripe.com https://m.stripe.network 'unsafe-inline';");

        return $response;
    }
}
