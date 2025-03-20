<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Allow superadmin to access everything
        if ($user->role === 'superadmin') {
            return $next($request);
        }

        // Check if user has the required role
        if ($user->role !== $role) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Unauthorized access.'
                ], 403);
            }
            
            return redirect()->route('home')
                ->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
