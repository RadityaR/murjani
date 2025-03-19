<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HakAksesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::when($request->search, function($query, $search) {
            return $query->where('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        })->paginate(10);

        return view('layouts.hakakses.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.hakakses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'nullable|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,manager,user',
            'permissions' => 'array',
            'permissions.*' => 'string',
        ]);

        $permissions = $request->permissions ?? [];
        
        if ($validated['role'] === 'admin') {
            $permissions[] = 'all';
        }

        User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
            'permissions' => array_unique($permissions),
            'is_active' => true,
        ]);

        return redirect()->route('hakakses.index')
            ->with('success', 'User created successfully with specified permissions.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hakakses = User::findOrFail($id);
        return view('layouts.hakakses.edit', compact('hakakses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'nullable|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|in:admin,manager,user',
            'permissions' => 'array',
            'permissions.*' => 'string',
            'is_active' => 'boolean',
        ]);

        $data = [
            'username' => $validated['username'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'is_active' => $request->has('is_active'),
        ];

        if (!empty($validated['password'])) {
            $data['password'] = bcrypt($validated['password']);
        }

        $permissions = $request->permissions ?? [];
        
        if ($validated['role'] === 'admin') {
            $permissions[] = 'all';
        }

        $data['permissions'] = array_unique($permissions);

        $user->update($data);

        return redirect()->route('hakakses.index')
            ->with('success', 'User permissions updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('hakakses.index')
            ->with('success', 'User deleted successfully.');
    }
} 