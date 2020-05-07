<?php

namespace Ilma\Ecosystem\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class GuardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, string $guard)
    {
        if($guard) {
            Auth::shouldUse($guard);
        }
        return $next($request);
    }
}
