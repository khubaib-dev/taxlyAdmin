<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('admin')->check())
        {
            $user = auth()->guard('admin')->user();
            if($user->role == 0)
            {
                return redirect()->route('adminDashboard');
            }
            if($user->role == 1)
            {
                return redirect()->route('officeDashboard');
            }
        }
        return $next($request);
    }
}
