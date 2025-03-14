<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'permissions' => json_encode(['all']),
            'is_active' => true,
            'last_login_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // Create manager user
        User::create([
            'username' => 'manager',
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'permissions' => json_encode(['view', 'create', 'edit']),
            'is_active' => true,
            'last_login_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // Create regular user
        User::create([
            'username' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'permissions' => json_encode(['view']),
            'is_active' => true,
            'last_login_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // Create 10 random users
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'username' => 'user' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'permissions' => json_encode(['view']),
                'is_active' => rand(0, 1),
                'last_login_at' => now()->subDays(rand(0, 30)),
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
