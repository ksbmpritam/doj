<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateFranchies
{
    public function handle($request, Closure $next)
    {
        if (!$request->session()->has('user')) {
            return redirect('franchise');
        }

        return $next($request);
    }
}