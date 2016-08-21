<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        $roles = array_filter(explode('|', $roles));

        if( ! in_array($request->user()->role, $roles)){
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return abort(403);
            }
        }

        return $next($request);
    }
}
