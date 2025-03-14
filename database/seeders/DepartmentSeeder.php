<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Main departments
        $departments = [
            [
                'name' => 'Human Resources',
                'code' => 'HR',
                'description' => 'Responsible for recruiting, onboarding, training, and administering employee benefit programs',
                'parent_id' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Finance',
                'code' => 'FIN',
                'description' => 'Responsible for financial planning, management, and reporting',
                'parent_id' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Information Technology',
                'code' => 'IT',
                'description' => 'Responsible for managing and maintaining technology infrastructure and systems',
                'parent_id' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Operations',
                'code' => 'OPS',
                'description' => 'Responsible for day-to-day operational activities',
                'parent_id' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Marketing',
                'code' => 'MKT',
                'description' => 'Responsible for promoting products and services',
                'parent_id' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Research and Development',
                'code' => 'R&D',
                'description' => 'Responsible for innovation and new product development',
                'parent_id' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Legal',
                'code' => 'LGL',
                'description' => 'Responsible for legal compliance and risk management',
                'parent_id' => null,
                'is_active' => true,
            ],
        ];

        // Insert main departments
        foreach ($departments as $department) {
            Department::create($department);
        }

        // Sub-departments
        $subDepartments = [
            // HR sub-departments
            [
                'name' => 'Recruitment',
                'code' => 'HR-REC',
                'description' => 'Responsible for attracting and hiring new employees',
                'parent_id' => 1, // HR
                'is_active' => true,
            ],
            [
                'name' => 'Training and Development',
                'code' => 'HR-TRN',
                'description' => 'Responsible for employee training and professional development',
                'parent_id' => 1, // HR
                'is_active' => true,
            ],
            
            // Finance sub-departments
            [
                'name' => 'Accounting',
                'code' => 'FIN-ACC',
                'description' => 'Responsible for recording financial transactions and reporting',
                'parent_id' => 2, // Finance
                'is_active' => true,
            ],
            [
                'name' => 'Payroll',
                'code' => 'FIN-PAY',
                'description' => 'Responsible for processing employee compensation',
                'parent_id' => 2, // Finance
                'is_active' => true,
            ],
            
            // IT sub-departments
            [
                'name' => 'Infrastructure',
                'code' => 'IT-INF',
                'description' => 'Responsible for managing hardware and network infrastructure',
                'parent_id' => 3, // IT
                'is_active' => true,
            ],
            [
                'name' => 'Software Development',
                'code' => 'IT-DEV',
                'description' => 'Responsible for developing and maintaining software applications',
                'parent_id' => 3, // IT
                'is_active' => true,
            ],
        ];

        // Insert sub-departments
        foreach ($subDepartments as $subDepartment) {
            Department::create($subDepartment);
        }
    }
}
