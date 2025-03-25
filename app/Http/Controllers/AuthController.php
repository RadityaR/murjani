<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Register a new user
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'nip' => 'required|string|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'username' => $request->username,
            'nip' => $request->nip,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'is_active' => true,
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'User registered successfully',
                'user' => $user
            ], 201);
        }

        Auth::login($user);
        return redirect()->route('dashboard.index');
    }

    /**
     * Login a user
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'nip' => 'required|string',
            'password' => 'required|string',
        ]);

        // Find the user by NIP
        $user = User::where('nip', $request->nip)->first();
        
        if ($user && Hash::check($request->password, $user->password)) {
            // Log in the user
            Auth::login($user);
            
            // Update last login timestamp
            $user->updateLastLogin();

            $request->session()->regenerate();

            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Login successful',
                    'user' => $user
                ]);
            }

            // Redirect admin users to dashboard, others to home
            if ($user->role === 'admin' || $user->role === 'superadmin') {
                return redirect()->route('dashboard.index');
            }

            // For regular users, check employee data
            if (!$user->employee) {
                session()->flash('employee_data_required', true);
            }

            return redirect()->route('home');
        }

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'The provided credentials do not match our records.'
            ], 401);
        }

        throw ValidationException::withMessages([
            'nip' => ['The provided credentials do not match our records.'],
        ]);
    }

    /**
     * Logout a user
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Logged out successfully'
            ]);
        }

        return redirect('/');
    }

    /**
     * Get the authenticated user
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function user(Request $request)
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated'
            ], 401);
        }
        
        return response()->json([
            'user' => $user
        ]);
    }
}
