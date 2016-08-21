<?php

namespace App\Http\Middleware;

use Closure;

class Convenience
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
        view()->share('me', auth()->user());

        return $next($request);
    }
}
