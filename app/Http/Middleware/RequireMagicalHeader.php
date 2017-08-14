<?php

namespace App\Http\Middleware;

use Closure;
use \Illuminate\Http\Response;

class RequireMagicalHeader
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
        if (!$request->headers->has('magical-header')) {
            abort(Response::HTTP_I_AM_A_TEAPOT, 'I\'m a teapot');
        }
        return $next($request);
    }
}
