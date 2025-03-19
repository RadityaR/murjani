<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
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
        $departments = Department::pluck('name', 'id');
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
            'email' => 'required|string|email|max:255|unique:users',
            'status' => 'required|in:active,suspended,pending',
        ]);

        // Set default values for other fields
        $userData = [
            'name' => $validated['name'],
            'nip' => $validated['nip'],
            'password' => Hash::make($validated['password']),
            'email' => $validated['email'],
            'is_active' => $validated['status'] === 'active',
            'status' => $validated['status'],
            'phone' => null,
            'position' => null,
            'notes' => null,
            'permissions' => ['user'] // Default permission
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
        if ($authUser && $authUser->id !== $user->id) {
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
        if ($authUser && $authUser->id !== $user->id) {
            abort(403, 'You can only update your own data.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|unique:users,nip,'.$user->id,
            'password' => 'nullable|string|min:8',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'status' => 'required|in:active,suspended,pending',
        ]);

        // Prepare update data
        $userData = [
            'name' => $validated['name'],
            'nip' => $validated['nip'],
            'email' => $validated['email'],
            'status' => $validated['status'],
            'is_active' => $validated['status'] === 'active',
        ];

        // Only update password if provided
        if (isset($validated['password']) && !empty($validated['password'])) {
            $userData['password'] = Hash::make($validated['password']);
        }

        $user->update($userData);

        return redirect()->route('home')
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
            $query->whereHas('employee', function($q) use ($request) {
                $q->where('department_id', $request->department);
            });
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
