<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Class RedirectIfAuthenticated
 * @package App\Http\Middleware
 */
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request Illuminate\Http\Request.
     * @param  \Closure                 $next    Next.
     * @param  string|null              $guard   Guard.
     * @return mixed
     */
    public function handle(\Illuminate\Http\Request $request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect(RouteServiceProvider::HOME);
        }
        return $next($request);
    }
}
