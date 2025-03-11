<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            [
                'name' => 'John Doe',
                'address' => 'Jl. Sudirman No. 123, Jakarta Pusat',
                'phone' => '081234567890',
                'email' => 'john.doe@example.com',
                'date_of_birth' => '1990-01-15',
                'gender' => 'Laki-Laki',
                'marital_status' => 'Menikah',
                'height_cm' => 175,
                'weight_kg' => 70,
                'blood_type' => 'O',
                'religion' => 'Islam',
                'hobby' => 'Reading, Swimming',
            ],
            [
                'name' => 'Jane Smith',
                'address' => 'Jl. Thamrin No. 45, Jakarta Selatan',
                'phone' => '081298765432',
                'email' => 'jane.smith@example.com',
                'date_of_birth' => '1992-05-20',
                'gender' => 'Perempuan',
                'marital_status' => 'Belum Menikah',
                'height_cm' => 165,
                'weight_kg' => 55,
                'blood_type' => 'A',
                'religion' => 'Kristen',
                'hobby' => 'Cooking, Traveling',
            ],
            [
                'name' => 'Ahmad Rizki',
                'address' => 'Jl. Gatot Subroto No. 78, Jakarta Timur',
                'phone' => '081345678901',
                'email' => 'ahmad.rizki@example.com',
                'date_of_birth' => '1988-09-10',
                'gender' => 'Laki-Laki',
                'marital_status' => 'Menikah',
                'height_cm' => 170,
                'weight_kg' => 65,
                'blood_type' => 'B',
                'religion' => 'Islam',
                'hobby' => 'Football, Photography',
            ],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
} 