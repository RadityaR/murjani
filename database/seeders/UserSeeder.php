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
        // Create superadmin user
        User::create([
            'username' => 'superadmin',
            'nip' => '198001010001',
            'password' => Hash::make('password'),
            'role' => 'superadmin',
            'is_active' => true,
            'last_login_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // Create admin users
        $adminNips = [
            '198001010002', // HR Admin
            '198001010003', // System Admin
            '198001010004', // Training Admin
        ];

        foreach ($adminNips as $nip) {
            User::create([
                'username' => 'admin_' . substr($nip, -4),
                'nip' => $nip,
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
                'last_login_at' => now(),
                'remember_token' => Str::random(10),
            ]);
        }

        // Create regular users (employees)
        $departments = [
            'IT' => ['198001010005', '198001010006', '198001010007'],
            'HR' => ['198001010008', '198001010009', '198001010010'],
            'Finance' => ['198001010011', '198001010012', '198001010013'],
            'Training' => ['198001010014', '198001010015', '198001010016'],
        ];

        foreach ($departments as $department => $nips) {
            foreach ($nips as $nip) {
                User::create([
                    'username' => 'user_' . substr($nip, -4),
                    'nip' => $nip,
                    'password' => Hash::make('password'),
                    'role' => 'user',
                    'is_active' => true,
                    'last_login_at' => now()->subDays(rand(0, 30)),
                    'remember_token' => Str::random(10),
                ]);
            }
        }

        // Create some inactive users for testing
        for ($i = 1; $i <= 5; $i++) {
            $year = rand(1990, 2000);
            $month = str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT);
            $day = str_pad(rand(1, 28), 2, '0', STR_PAD_LEFT);
            $sequence = str_pad($i + 100, 4, '0', STR_PAD_LEFT);
            
            User::create([
                'username' => 'inactive_user_' . $i,
                'nip' => $year . $month . $day . $sequence,
                'password' => Hash::make('password'),
                'role' => 'user',
                'is_active' => false,
                'last_login_at' => now()->subDays(rand(30, 90)),
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
