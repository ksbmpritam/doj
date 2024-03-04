<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateSession
{
    public function handle($request, Closure $next)
    {
        if (!$request->session()->has('user')) {
            return redirect('restaurant');
        }

        return $next($request);
    }
}
