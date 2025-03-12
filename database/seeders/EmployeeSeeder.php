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
                'ktp_number' => '3175012345678901',
                'nip' => '198001012010011001',
                'golongan' => 'III/a',
                'employee_status' => 'PNS',
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
                'ktp_number' => '3175023456789012',
                'nip' => '199005202015022002',
                'golongan' => 'III/b',
                'employee_status' => 'PNS',
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
                'ktp_number' => '3175034567890123',
                'nip' => null,
                'golongan' => null,
                'employee_status' => 'Kontrak',
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
            [
                'name' => 'Siti Rahayu',
                'ktp_number' => '3175045678901234',
                'nip' => '198703152020032001',
                'golongan' => null,
                'employee_status' => 'PPPK',
                'address' => 'Jl. Merdeka No. 56, Jakarta Barat',
                'phone' => '081456789012',
                'email' => 'siti.rahayu@example.com',
                'date_of_birth' => '1987-03-15',
                'gender' => 'Perempuan',
                'marital_status' => 'Menikah',
                'height_cm' => 160,
                'weight_kg' => 52,
                'blood_type' => 'AB',
                'religion' => 'Islam',
                'hobby' => 'Reading, Gardening',
            ],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
} 