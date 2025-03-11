<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\WorkExperience;
use Illuminate\Database\Seeder;

class WorkExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all employees
        $employees = Employee::all();

        foreach ($employees as $employee) {
            if ($employee->id === 1) {
                // John Doe's work experience
                WorkExperience::create([
                    'employee_id' => $employee->id,
                    'company' => 'PT Teknologi Maju',
                    'position' => 'Senior Software Engineer',
                    'start_date' => '2018-03-01',
                    'end_date' => null, // Current job
                    'description' => 'Leading development team in creating enterprise software solutions.',
                ]);

                WorkExperience::create([
                    'employee_id' => $employee->id,
                    'company' => 'PT Digital Solutions',
                    'position' => 'Software Engineer',
                    'start_date' => '2015-06-01',
                    'end_date' => '2018-02-28',
                    'description' => 'Developed and maintained web applications using Laravel and Vue.js.',
                ]);
            } elseif ($employee->id === 2) {
                // Jane Smith's work experience
                WorkExperience::create([
                    'employee_id' => $employee->id,
                    'company' => 'PT Marketing Global',
                    'position' => 'Digital Marketing Manager',
                    'start_date' => '2019-01-15',
                    'end_date' => null, // Current job
                    'description' => 'Managing digital marketing campaigns and social media strategies.',
                ]);

                WorkExperience::create([
                    'employee_id' => $employee->id,
                    'company' => 'PT Media Kreatif',
                    'position' => 'Marketing Specialist',
                    'start_date' => '2016-08-01',
                    'end_date' => '2018-12-31',
                    'description' => 'Executed marketing campaigns and analyzed market trends.',
                ]);
            } elseif ($employee->id === 3) {
                // Ahmad Rizki's work experience
                WorkExperience::create([
                    'employee_id' => $employee->id,
                    'company' => 'PT Konstruksi Utama',
                    'position' => 'Project Manager',
                    'start_date' => '2017-04-01',
                    'end_date' => null, // Current job
                    'description' => 'Managing large-scale construction projects and team coordination.',
                ]);

                WorkExperience::create([
                    'employee_id' => $employee->id,
                    'company' => 'PT Pembangunan Jaya',
                    'position' => 'Site Engineer',
                    'start_date' => '2014-07-01',
                    'end_date' => '2017-03-31',
                    'description' => 'Supervised construction sites and managed project timelines.',
                ]);
            }
        }
    }
} 