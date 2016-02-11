<?php

namespace App\Http\Middleware;

use Input;
use Response;
use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->input('token');
        if ($token!='juvdopij348fghkln2345jklfhm12') {
            return Response::json([], 401);
        } else {
            return $next($request);
        }
    }
}
