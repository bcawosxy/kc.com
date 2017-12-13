<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AdminLogin
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('web')->check()) {
            return $next($request);
        } else {
            return redirect()->route('KC::login');
        }
    }
}
