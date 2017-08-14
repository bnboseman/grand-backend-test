<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class LogRequests
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
        DB::table('logs')->insert(
            ['route' => $request->path(),
                'magical-header' => $request->headers->has('magical-header')]
        );
        return $next($request);
    }
}
