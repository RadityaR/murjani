<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WorkExperience;
use App\Models\Employee;
use Faker\Factory as Faker;

class WorkExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
        // Get all employees
        $employees = Employee::all();
        
        // Indonesian companies
        $companies = [
            'PT Telkom Indonesia',
            'PT Bank Mandiri',
            'PT Bank Rakyat Indonesia',
            'PT Bank Central Asia',
            'PT Pertamina',
            'PT PLN',
            'PT Astra International',
            'PT Unilever Indonesia',
            'PT Indofood Sukses Makmur',
            'PT Semen Indonesia',
            'PT Garuda Indonesia',
            'PT Wijaya Karya',
            'PT Adaro Energy',
            'PT Kalbe Farma',
            'PT Indosat',
            'PT XL Axiata',
            'PT Bukalapak',
            'PT Tokopedia',
            'PT Gojek Indonesia',
            'PT Traveloka',
        ];
        
        // Positions
        $positions = [
            'Staff',
            'Senior Staff',
            'Supervisor',
            'Assistant Manager',
            'Manager',
            'Senior Manager',
            'Assistant Director',
            'Director',
            'Vice President',
            'Senior Vice President',
            'Executive Vice President',
            'Chief Officer',
        ];
        
        // Departments
        $departments = [
            'Human Resources',
            'Finance',
            'Accounting',
            'Marketing',
            'Sales',
            'Operations',
            'Information Technology',
            'Research and Development',
            'Legal',
            'Customer Service',
            'Production',
            'Quality Assurance',
            'Supply Chain',
            'Procurement',
            'Public Relations',
        ];
        
        // Locations
        $locations = [
            'Jakarta',
            'Bandung',
            'Surabaya',
            'Medan',
            'Makassar',
            'Semarang',
            'Yogyakarta',
            'Palembang',
            'Denpasar',
            'Balikpapan',
        ];
        
        // Employment types
        $employmentTypes = [
            'full_time',
            'part_time',
            'contract',
            'internship',
            'freelance',
        ];
        
        // For each employee, create 1-3 work experiences
        foreach ($employees as $employee) {
            $experienceCount = $faker->numberBetween(1, 3);
            
            // Current job (if applicable)
            if ($faker->boolean(80)) {
                WorkExperience::create([
                    'employee_id' => $employee->id,
                    'company_name' => $faker->randomElement($companies),
                    'position' => $faker->randomElement($positions),
                    'department' => $faker->randomElement($departments),
                    'location' => $faker->randomElement($locations),
                    'employment_type' => $faker->randomElement($employmentTypes),
                    'start_date' => $faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
                    'end_date' => null,
                    'is_current' => true,
                    'responsibilities' => $faker->paragraphs(2, true),
                    'achievements' => $faker->boolean(70) ? $faker->paragraphs(1, true) : null,
                    'reference_name' => $faker->boolean(50) ? $faker->name : null,
                    'reference_contact' => $faker->boolean(50) ? $faker->phoneNumber : null,
                ]);
                
                $experienceCount--; // Reduce the count since we already added one
            }
            
            // Past jobs
            for ($i = 0; $i < $experienceCount; $i++) {
                $startDate = $faker->dateTimeBetween('-15 years', '-1 year');
                $endDate = $faker->dateTimeBetween($startDate, 'now');
                
                WorkExperience::create([
                    'employee_id' => $employee->id,
                    'company_name' => $faker->randomElement($companies),
                    'position' => $faker->randomElement($positions),
                    'department' => $faker->randomElement($departments),
                    'location' => $faker->randomElement($locations),
                    'employment_type' => $faker->randomElement($employmentTypes),
                    'start_date' => $startDate->format('Y-m-d'),
                    'end_date' => $endDate->format('Y-m-d'),
                    'is_current' => false,
                    'responsibilities' => $faker->paragraphs(2, true),
                    'achievements' => $faker->boolean(70) ? $faker->paragraphs(1, true) : null,
                    'reference_name' => $faker->boolean(50) ? $faker->name : null,
                    'reference_contact' => $faker->boolean(50) ? $faker->phoneNumber : null,
                ]);
            }
        }
    }
}
