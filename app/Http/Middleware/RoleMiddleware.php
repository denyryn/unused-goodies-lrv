<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        /*
         * Check if the user is authenticated and their role matches the required role
         * This utilizes the RoleEnum to ensure the user's role is properly validated
         */
        if (!Auth::check() || Auth::user()->role !== $role) {
            abort(403, 'Unauthorized access');
        }
        return $next($request);
    }
}
