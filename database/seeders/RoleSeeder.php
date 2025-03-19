<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Administrator',
                'slug' => 'admin',
                'description' => 'Full access to all features',
                'permissions' => ['all'],
                'is_active' => true,
            ],
            [
                'name' => 'Manager',
                'slug' => 'manager',
                'description' => 'Manages users and employees with limited administrative access',
                'permissions' => [
                    'view_users', 'create_users', 'edit_users',
                    'view_employees', 'create_employees', 'edit_employees'
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Employee',
                'slug' => 'employee',
                'description' => 'Regular employee with basic access',
                'permissions' => ['view_employees'],
                'is_active' => true,
            ],
            [
                'name' => 'HR Staff',
                'slug' => 'hr-staff',
                'description' => 'Human Resources staff with access to employee records',
                'permissions' => [
                    'view_employees', 'create_employees', 'edit_employees'
                ],
                'is_active' => true,
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
