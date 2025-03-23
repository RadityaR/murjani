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
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
            'last_login_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // Create admin user (previously manager)
        User::create([
            'username' => 'manager',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
            'last_login_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // Create regular user
        User::create([
            'username' => 'user',
            'password' => Hash::make('password'),
            'role' => 'user',
            'is_active' => true,
            'last_login_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // Create 10 random users
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'username' => 'user' . $i,
                'password' => Hash::make('password'),
                'role' => 'user',
                'is_active' => rand(0, 1),
                'last_login_at' => now()->subDays(rand(0, 30)),
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
