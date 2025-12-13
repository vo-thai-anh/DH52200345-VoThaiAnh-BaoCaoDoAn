<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class AuthenticateAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Allow the request to continue only for authenticated admin users.
        if (Auth::check() && Auth::user()->isAdmin()) {
            return $next($request);
        }

        // For non-admins, redirect to login or show 403. Adjust as needed.
        return redirect('/login');
    }
}
