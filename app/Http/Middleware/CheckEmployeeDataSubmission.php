<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckEmployeeDataSubmission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        
        // Skip check for admin users
        if ($user->role === 'admin' || $user->role === 'superadmin') {
            return $next($request);
        }
        
        // Routes that are always allowed
        $allowedRoutes = [
            'profile.changepassword',
            'profile.password',
            'employees.create',
            'employees.store',
        ];
        
        // Check if the current route is in the allowed list
        foreach ($allowedRoutes as $route) {
            if ($request->routeIs($route)) {
                return $next($request);
            }
        }
        
        // Check if the user has submitted employee data
        if (!$user->employee) {
            // For AJAX requests, return a JSON response
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Anda perlu melengkapi data pegawai terlebih dahulu.',
                    'redirect' => route('home')
                ], 403);
            }
            
            // For regular requests, redirect with a message
            return redirect()->route('home')
                ->with('employee_data_required', true)
                ->with('warning', 'Anda perlu melengkapi data pegawai terlebih dahulu.');
        }
        
        return $next($request);
    }
} 