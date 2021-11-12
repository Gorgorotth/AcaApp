<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth('admin')->check()){
            return redirect('/admin')->with('error', 'You are not logged in as admin');
        }
        auth()->shouldUse('admin');
        return $next($request);
    }
}
