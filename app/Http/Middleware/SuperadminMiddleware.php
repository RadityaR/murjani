<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperadminMiddleware
{
    /**
     * Handle an incoming request to check if user has superadmin role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            return redirect()->route('login');
        }

        // Get authenticated user
        $user = Auth::user();
        
        // Check if user has superadmin role
        if ($user->role === 'superadmin') {
            return $next($request);
        }
        
        // User doesn't have the required role
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Forbidden: Insufficient permissions'], 403);
        }
        
        return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
    }
} 