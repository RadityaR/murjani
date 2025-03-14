<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Executive positions
        $executivePositions = [
            [
                'title' => 'Chief Executive Officer',
                'code' => 'CEO',
                'description' => 'Highest-ranking executive responsible for overall management',
                'department_id' => null,
                'level' => 10,
                'is_active' => true,
            ],
            [
                'title' => 'Chief Financial Officer',
                'code' => 'CFO',
                'description' => 'Executive responsible for financial operations',
                'department_id' => 2, // Finance
                'level' => 9,
                'is_active' => true,
            ],
            [
                'title' => 'Chief Technology Officer',
                'code' => 'CTO',
                'description' => 'Executive responsible for technological operations',
                'department_id' => 3, // IT
                'level' => 9,
                'is_active' => true,
            ],
            [
                'title' => 'Chief Operations Officer',
                'code' => 'COO',
                'description' => 'Executive responsible for day-to-day operations',
                'department_id' => 4, // Operations
                'level' => 9,
                'is_active' => true,
            ],
        ];

        // Insert executive positions
        foreach ($executivePositions as $position) {
            Position::create($position);
        }

        // Director positions
        $directorPositions = [
            [
                'title' => 'HR Director',
                'code' => 'HR-DIR',
                'description' => 'Director of Human Resources department',
                'department_id' => 1, // HR
                'level' => 8,
                'is_active' => true,
            ],
            [
                'title' => 'Finance Director',
                'code' => 'FIN-DIR',
                'description' => 'Director of Finance department',
                'department_id' => 2, // Finance
                'level' => 8,
                'is_active' => true,
            ],
            [
                'title' => 'IT Director',
                'code' => 'IT-DIR',
                'description' => 'Director of IT department',
                'department_id' => 3, // IT
                'level' => 8,
                'is_active' => true,
            ],
        ];

        // Insert director positions
        foreach ($directorPositions as $position) {
            Position::create($position);
        }

        // Manager positions
        $managerPositions = [
            [
                'title' => 'HR Manager',
                'code' => 'HR-MGR',
                'description' => 'Manager of Human Resources department',
                'department_id' => 1, // HR
                'level' => 7,
                'is_active' => true,
            ],
            [
                'title' => 'Recruitment Manager',
                'code' => 'HR-REC-MGR',
                'description' => 'Manager of Recruitment team',
                'department_id' => 8, // Recruitment
                'level' => 6,
                'is_active' => true,
            ],
            [
                'title' => 'Training Manager',
                'code' => 'HR-TRN-MGR',
                'description' => 'Manager of Training and Development team',
                'department_id' => 9, // Training and Development
                'level' => 6,
                'is_active' => true,
            ],
            [
                'title' => 'Finance Manager',
                'code' => 'FIN-MGR',
                'description' => 'Manager of Finance department',
                'department_id' => 2, // Finance
                'level' => 7,
                'is_active' => true,
            ],
            [
                'title' => 'Accounting Manager',
                'code' => 'FIN-ACC-MGR',
                'description' => 'Manager of Accounting team',
                'department_id' => 10, // Accounting
                'level' => 6,
                'is_active' => true,
            ],
            [
                'title' => 'Payroll Manager',
                'code' => 'FIN-PAY-MGR',
                'description' => 'Manager of Payroll team',
                'department_id' => 11, // Payroll
                'level' => 6,
                'is_active' => true,
            ],
            [
                'title' => 'IT Manager',
                'code' => 'IT-MGR',
                'description' => 'Manager of IT department',
                'department_id' => 3, // IT
                'level' => 7,
                'is_active' => true,
            ],
            [
                'title' => 'Infrastructure Manager',
                'code' => 'IT-INF-MGR',
                'description' => 'Manager of IT Infrastructure team',
                'department_id' => 12, // Infrastructure
                'level' => 6,
                'is_active' => true,
            ],
            [
                'title' => 'Development Manager',
                'code' => 'IT-DEV-MGR',
                'description' => 'Manager of Software Development team',
                'department_id' => 13, // Software Development
                'level' => 6,
                'is_active' => true,
            ],
        ];

        // Insert manager positions
        foreach ($managerPositions as $position) {
            Position::create($position);
        }

        // Staff positions
        $staffPositions = [
            [
                'title' => 'HR Specialist',
                'code' => 'HR-SPC',
                'description' => 'Human Resources Specialist',
                'department_id' => 1, // HR
                'level' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Recruiter',
                'code' => 'HR-REC-SPC',
                'description' => 'Recruitment Specialist',
                'department_id' => 8, // Recruitment
                'level' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Trainer',
                'code' => 'HR-TRN-SPC',
                'description' => 'Training Specialist',
                'department_id' => 9, // Training and Development
                'level' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Accountant',
                'code' => 'FIN-ACC-SPC',
                'description' => 'Accounting Specialist',
                'department_id' => 10, // Accounting
                'level' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Payroll Specialist',
                'code' => 'FIN-PAY-SPC',
                'description' => 'Payroll Processing Specialist',
                'department_id' => 11, // Payroll
                'level' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'System Administrator',
                'code' => 'IT-INF-SPC',
                'description' => 'IT Infrastructure Specialist',
                'department_id' => 12, // Infrastructure
                'level' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Software Developer',
                'code' => 'IT-DEV-SPC',
                'description' => 'Software Development Specialist',
                'department_id' => 13, // Software Development
                'level' => 3,
                'is_active' => true,
            ],
        ];

        // Insert staff positions
        foreach ($staffPositions as $position) {
            Position::create($position);
        }
    }
}
