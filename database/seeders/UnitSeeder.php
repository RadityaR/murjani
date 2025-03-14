<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            [
                'name' => 'Headquarters',
                'code' => 'HQ',
                'description' => 'Main headquarters office',
                'department_id' => null,
                'location' => 'Jakarta',
                'is_active' => true,
            ],
            [
                'name' => 'HR Unit',
                'code' => 'HR-UNIT',
                'description' => 'Human Resources Unit',
                'department_id' => 1, // HR
                'location' => 'Jakarta',
                'is_active' => true,
            ],
            [
                'name' => 'Finance Unit',
                'code' => 'FIN-UNIT',
                'description' => 'Finance Unit',
                'department_id' => 2, // Finance
                'location' => 'Jakarta',
                'is_active' => true,
            ],
            [
                'name' => 'IT Unit',
                'code' => 'IT-UNIT',
                'description' => 'Information Technology Unit',
                'department_id' => 3, // IT
                'location' => 'Jakarta',
                'is_active' => true,
            ],
            [
                'name' => 'Operations Unit',
                'code' => 'OPS-UNIT',
                'description' => 'Operations Unit',
                'department_id' => 4, // Operations
                'location' => 'Jakarta',
                'is_active' => true,
            ],
            [
                'name' => 'Marketing Unit',
                'code' => 'MKT-UNIT',
                'description' => 'Marketing Unit',
                'department_id' => 5, // Marketing
                'location' => 'Jakarta',
                'is_active' => true,
            ],
            [
                'name' => 'R&D Unit',
                'code' => 'RND-UNIT',
                'description' => 'Research and Development Unit',
                'department_id' => 6, // R&D
                'location' => 'Bandung',
                'is_active' => true,
            ],
            [
                'name' => 'Legal Unit',
                'code' => 'LGL-UNIT',
                'description' => 'Legal Unit',
                'department_id' => 7, // Legal
                'location' => 'Jakarta',
                'is_active' => true,
            ],
            [
                'name' => 'Recruitment Unit',
                'code' => 'HR-REC-UNIT',
                'description' => 'Recruitment Unit',
                'department_id' => 8, // Recruitment
                'location' => 'Jakarta',
                'is_active' => true,
            ],
            [
                'name' => 'Training Unit',
                'code' => 'HR-TRN-UNIT',
                'description' => 'Training and Development Unit',
                'department_id' => 9, // Training and Development
                'location' => 'Jakarta',
                'is_active' => true,
            ],
            [
                'name' => 'Accounting Unit',
                'code' => 'FIN-ACC-UNIT',
                'description' => 'Accounting Unit',
                'department_id' => 10, // Accounting
                'location' => 'Jakarta',
                'is_active' => true,
            ],
            [
                'name' => 'Payroll Unit',
                'code' => 'FIN-PAY-UNIT',
                'description' => 'Payroll Unit',
                'department_id' => 11, // Payroll
                'location' => 'Jakarta',
                'is_active' => true,
            ],
            [
                'name' => 'Infrastructure Unit',
                'code' => 'IT-INF-UNIT',
                'description' => 'IT Infrastructure Unit',
                'department_id' => 12, // Infrastructure
                'location' => 'Jakarta',
                'is_active' => true,
            ],
            [
                'name' => 'Development Unit',
                'code' => 'IT-DEV-UNIT',
                'description' => 'Software Development Unit',
                'department_id' => 13, // Software Development
                'location' => 'Jakarta',
                'is_active' => true,
            ],
            [
                'name' => 'Regional Office - Surabaya',
                'code' => 'REG-SBY',
                'description' => 'Regional Office in Surabaya',
                'department_id' => 4, // Operations
                'location' => 'Surabaya',
                'is_active' => true,
            ],
            [
                'name' => 'Regional Office - Medan',
                'code' => 'REG-MDN',
                'description' => 'Regional Office in Medan',
                'department_id' => 4, // Operations
                'location' => 'Medan',
                'is_active' => true,
            ],
            [
                'name' => 'Regional Office - Makassar',
                'code' => 'REG-MKS',
                'description' => 'Regional Office in Makassar',
                'department_id' => 4, // Operations
                'location' => 'Makassar',
                'is_active' => true,
            ],
        ];

        // Insert units
        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
