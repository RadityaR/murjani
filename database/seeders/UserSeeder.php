<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin User',
                'nip' => '123456789',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'HR Manager',
                'nip' => '987654321',
                'password' => Hash::make('password'),
                'role' => 'hr',
            ],
            [
                'name' => 'Regular User',
                'nip' => '456789123',
                'password' => Hash::make('password'),
                'role' => 'user',
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
} 