<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        // Middleware is now handled in routes
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $departments = User::distinct('department')->pluck('department')->filter();
        return view('users.index', compact('users', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,hr,user',
            'email' => 'required|string|email|max:255|unique:users',
            'status' => 'required|in:active,suspended,pending',
        ]);

        // Set default values for other fields
        $userData = [
            'name' => $validated['name'],
            'nip' => $validated['nip'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'email' => $validated['email'],
            'is_active' => $validated['status'] === 'active',
            'status' => $validated['status'],
            'phone' => null,
            'department' => null,
            'position' => null,
            'notes' => null,
            'permissions' => null
        ];
        
        User::create($userData);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Check if the authenticated user is trying to edit their own data
        $authUser = Auth::user();
        if ($authUser && $authUser->role !== 'admin' && $authUser->nip !== $user->nip) {
            abort(403, 'You can only edit your own data.');
        }

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Check if the authenticated user is trying to update their own data
        $authUser = Auth::user();
        if ($authUser && $authUser->role !== 'admin' && $authUser->nip !== $user->nip) {
            abort(403, 'You can only update your own data.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|unique:users,nip,'.$user->id,
            'password' => 'nullable|string|min:8',
            'role' => $authUser && $authUser->role === 'admin' ? 'required|in:admin,hr,user' : 'prohibited',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'status' => $authUser && $authUser->role === 'admin' ? 'required|in:active,suspended,pending' : 'prohibited',
        ]);

        // Prepare update data
        $userData = [
            'name' => $validated['name'],
            'nip' => $validated['nip'],
            'email' => $validated['email'],
        ];

        // Only update password if provided
        if (isset($validated['password']) && !empty($validated['password'])) {
            $userData['password'] = Hash::make($validated['password']);
        }

        // Only admin can update role and status
        if ($authUser && $authUser->role === 'admin') {
            $userData['role'] = $validated['role'];
            $userData['status'] = $validated['status'];
            $userData['is_active'] = $validated['status'] === 'active';
        }

        $user->update($userData);

        return redirect()->route($authUser && $authUser->role === 'admin' ? 'users.index' : 'home')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }

    /**
     * Bulk action on users
     */
    public function bulkAction(Request $request)
    {
        $validated = $request->validate([
            'action' => 'required|in:activate,deactivate,delete',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id'
        ]);

        $authUser = Auth::user();
        if (!$authUser || $authUser->role !== 'admin') {
            abort(403, 'Only administrators can perform bulk actions.');
        }

        $users = User::whereIn('id', $validated['user_ids']);
        
        switch ($validated['action']) {
            case 'activate':
                $users->update(['is_active' => true, 'status' => 'active']);
                $message = 'Selected users have been activated.';
                break;
            case 'deactivate':
                $users->update(['is_active' => false, 'status' => 'suspended']);
                $message = 'Selected users have been deactivated.';
                break;
            case 'delete':
                $users->delete();
                $message = 'Selected users have been deleted.';
                break;
        }

        return redirect()->route('users.index')->with('success', $message);
    }

    /**
     * Filter users
     */
    public function filter(Request $request)
    {
        $query = User::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%");
            });
        }

        $users = $query->get();
        
        // Format the last_login_at field for display
        $users->transform(function ($user) {
            $user->last_login_at = $user->last_login_at ? $user->last_login_at->diffForHumans() : null;
            return $user;
        });

        return response()->json($users);
    }
}
