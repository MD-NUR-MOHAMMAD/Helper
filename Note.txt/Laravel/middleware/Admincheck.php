<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Admincheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check if the authenticated user has the 'admin' role
            if (Auth::user()->role === 'admin') {
                return $next($request);
            }
        }

        // If not admin, redirect or return unauthorized response
        return redirect()->route('home')->with('error', 'You are not authorized to access this page.');
    }
}
