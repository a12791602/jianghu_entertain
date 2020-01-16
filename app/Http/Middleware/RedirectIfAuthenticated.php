<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
     * @param Request  $request Request.
     * @param \Closure $next    Next.
     * @param string   $guard   Guard.
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $guard = '')
    {
        if (Auth::guard($guard)->check()) {
            $redirect = redirect('/home');
            return $redirect;
        }
        $result = $next($request);
        return $result;
    }
}
