<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of roles for a specific user.
     */
    public function index(User $user)
    {
        $userRoles = $user->roles;
        $availableRoles = Role::whereNotIn('id', $userRoles->pluck('id'))->get();
        
        return view('user-roles.index', compact('user', 'userRoles', 'availableRoles'));
    }

    /**
     * Assign a role to a user.
     */
    public function assign(Request $request, User $user)
    {
        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id'
        ]);
        
        $role = Role::findOrFail($validated['role_id']);
        $user->assignRole($role);
        
        return redirect()->route('user-roles.index', $user)
            ->with('success', "Role '{$role->name}' assigned successfully.");
    }

    /**
     * Remove a role from a user.
     */
    public function remove(Request $request, User $user, Role $role)
    {
        $user->removeRole($role);
        
        return redirect()->route('user-roles.index', $user)
            ->with('success', "Role '{$role->name}' removed successfully.");
    }
}
