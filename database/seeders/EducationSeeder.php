<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all employees
        $employees = Employee::all();

        foreach ($employees as $employee) {
            // Formal Education
            Education::create([
                'employee_id' => $employee->id,
                'type' => 'formal',
                'institution_name' => 'SMA Negeri 1 Jakarta',
                'level' => 'SLTA',
                'course_name' => null,
            ]);

            Education::create([
                'employee_id' => $employee->id,
                'type' => 'formal',
                'institution_name' => 'Universitas Indonesia',
                'level' => 'S1',
                'course_name' => null,
            ]);

            Education::create([
                'employee_id' => $employee->id,
                'type' => 'formal',
                'institution_name' => 'Institut Teknologi Bandung',
                'level' => 'S2',
                'course_name' => null,
            ]);

            // Informal Education
            Education::create([
                'employee_id' => $employee->id,
                'type' => 'informal',
                'institution_name' => 'English First',
                'level' => null,
                'course_name' => 'Business English',
            ]);

            if ($employee->id === 1) {
                Education::create([
                    'employee_id' => $employee->id,
                    'type' => 'informal',
                    'institution_name' => 'Digital Talent',
                    'level' => null,
                    'course_name' => 'Web Development Bootcamp',
                ]);
            } elseif ($employee->id === 2) {
                Education::create([
                    'employee_id' => $employee->id,
                    'type' => 'informal',
                    'institution_name' => 'Udemy',
                    'level' => null,
                    'course_name' => 'Digital Marketing Masterclass',
                ]);
            } elseif ($employee->id === 3) {
                Education::create([
                    'employee_id' => $employee->id,
                    'type' => 'informal',
                    'institution_name' => 'Coursera',
                    'level' => null,
                    'course_name' => 'Project Management Professional',
                ]);
            }
        }
    }
} 