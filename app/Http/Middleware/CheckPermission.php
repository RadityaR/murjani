<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $permission
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $permission = null): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // If no permission is specified, just check if user is authenticated
        if ($permission === null) {
            return $next($request);
        }

        // Check if user has the specific permission or if any of their roles have it
        if ($user->hasPermission($permission)) {
            return $next($request);
        }

        // Check if any of the user's roles have the permission
        foreach ($user->roles as $role) {
            if ($role->hasPermission($permission) || $role->hasPermission('all')) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized action. You do not have the required permission.');
    }
}
