<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function up(): void
    {
        // Create admin user
        User::create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'permissions' => ['all'],
            'is_active' => true,
        ]);

        // Create regular user
        User::create([
            'username' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'permissions' => ['submit_forms', 'view_documents'],
            'is_active' => true,
        ]);

        // Create manager user
        User::create([
            'username' => 'manager',
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'permissions' => ['manage_employees', 'manage_forms', 'review_documents'],
            'is_active' => true,
        ]);
    }

    /**
     * Reverse the database seeds.
     */
    public function down(): void
    {
        User::whereIn('username', ['admin', 'user', 'manager'])->delete();
    }
} 