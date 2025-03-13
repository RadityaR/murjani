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
                'nip' => 'admin123',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
                'status' => 'active',
                'phone' => '081234567890',
                'department' => 'IT',
                'position' => 'System Administrator'
            ],
            [
                'name' => 'John Doe',
                'nip' => '198001012010011001',
                'password' => Hash::make('password'),
                'role' => 'user',
                'is_active' => true,
                'status' => 'active',
                'phone' => '081234567890',
                'department' => 'Puskesmas Kota',
                'position' => 'Kepala Seksi'
            ],
            [
                'name' => 'Jane Smith',
                'nip' => '199005202015022002',
                'password' => Hash::make('password'),
                'role' => 'user',
                'is_active' => true,
                'status' => 'active',
                'phone' => '081298765432',
                'department' => 'RSUD Kota',
                'position' => 'Dokter Umum'
            ],
            [
                'name' => 'Ahmad Rizki',
                'nip' => '201001012022011001',
                'password' => Hash::make('password'),
                'role' => 'user',
                'is_active' => true,
                'status' => 'active',
                'phone' => '081345678901',
                'department' => 'Dinas Kesehatan',
                'position' => 'Staff Administrasi'
            ],
            [
                'name' => 'Siti Rahayu',
                'nip' => '198703152020032001',
                'password' => Hash::make('password'),
                'role' => 'user',
                'is_active' => true,
                'status' => 'active',
                'phone' => '081456789012',
                'department' => 'Puskesmas Desa',
                'position' => 'Perawat'
            ],
            [
                'name' => 'Budi Santoso',
                'nip' => '198505052018011002',
                'password' => Hash::make('password'),
                'role' => 'hr',
                'is_active' => true,
                'status' => 'active',
                'phone' => '081567890123',
                'department' => 'Dinas Kesehatan',
                'position' => 'Kepala Dinas'
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
} 