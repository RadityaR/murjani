<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FamilyMember;
use App\Models\Employee;
use Faker\Factory as Faker;

class FamilyMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
        // Get all employees
        $employees = Employee::all();
        
        // Education levels
        $educationLevels = [
            'Elementary School',
            'Junior High School',
            'High School',
            'Diploma',
            'Bachelor',
            'Master',
            'Doctorate',
        ];
        
        // Occupations
        $occupations = [
            'Teacher',
            'Doctor',
            'Engineer',
            'Accountant',
            'Lawyer',
            'Nurse',
            'Civil Servant',
            'Entrepreneur',
            'Housewife/Househusband',
            'Student',
            'Retired',
            'Unemployed',
        ];
        
        // For each employee, create family members
        foreach ($employees as $employee) {
            // Determine marital status
            $isMarried = $employee->marital_status === 'married';
            
            // Create spouse if married
            if ($isMarried) {
                $spouseGender = $employee->gender === 'male' ? 'female' : 'male';
                
                FamilyMember::create([
                    'employee_id' => $employee->id,
                    'full_name' => $faker->name($spouseGender),
                    'relationship' => 'spouse',
                    'identity_number' => $faker->unique()->numerify('################'),
                    'birth_date' => $faker->dateTimeBetween('-60 years', '-20 years')->format('Y-m-d'),
                    'gender' => $spouseGender,
                    'occupation' => $faker->randomElement($occupations),
                    'education_level' => $faker->randomElement($educationLevels),
                    'is_dependent' => true,
                    'is_emergency_contact' => true,
                    'phone_number' => $faker->phoneNumber,
                    'address' => $faker->boolean(80) ? $employee->address : $faker->address,
                    'notes' => $faker->boolean(30) ? $faker->sentence : null,
                ]);
                
                // Create children (0-4)
                $childrenCount = $faker->numberBetween(0, 4);
                for ($i = 0; $i < $childrenCount; $i++) {
                    $childGender = $faker->randomElement(['male', 'female']);
                    $childAge = $faker->numberBetween(1, 25);
                    $isDependent = $childAge < 18;
                    $occupation = $childAge < 5 ? null : ($childAge < 18 ? 'Student' : $faker->randomElement($occupations));
                    $educationLevel = $childAge < 5 ? null : ($childAge < 12 ? 'Elementary School' : ($childAge < 15 ? 'Junior High School' : ($childAge < 18 ? 'High School' : $faker->randomElement($educationLevels))));
                    
                    FamilyMember::create([
                        'employee_id' => $employee->id,
                        'full_name' => $faker->name($childGender),
                        'relationship' => 'child',
                        'identity_number' => $childAge >= 17 ? $faker->unique()->numerify('################') : null,
                        'birth_date' => $faker->dateTimeBetween('-' . $childAge . ' years', '-' . ($childAge - 1) . ' years')->format('Y-m-d'),
                        'gender' => $childGender,
                        'occupation' => $occupation,
                        'education_level' => $educationLevel,
                        'is_dependent' => $isDependent,
                        'is_emergency_contact' => $childAge >= 17,
                        'phone_number' => $childAge >= 12 ? $faker->phoneNumber : null,
                        'address' => $employee->address,
                        'notes' => $faker->boolean(20) ? $faker->sentence : null,
                    ]);
                }
            }
            
            // Create parents (0-2)
            $parentsCount = $faker->numberBetween(0, 2);
            for ($i = 0; $i < $parentsCount; $i++) {
                $parentGender = $i === 0 ? 'male' : 'female';
                
                FamilyMember::create([
                    'employee_id' => $employee->id,
                    'full_name' => $faker->name($parentGender),
                    'relationship' => 'parent',
                    'identity_number' => $faker->unique()->numerify('################'),
                    'birth_date' => $faker->dateTimeBetween('-85 years', '-50 years')->format('Y-m-d'),
                    'gender' => $parentGender,
                    'occupation' => $faker->randomElement(['Retired', ...$occupations]),
                    'education_level' => $faker->randomElement($educationLevels),
                    'is_dependent' => $faker->boolean(30),
                    'is_emergency_contact' => true,
                    'phone_number' => $faker->phoneNumber,
                    'address' => $faker->boolean(50) ? $employee->address : $faker->address,
                    'notes' => $faker->boolean(30) ? $faker->sentence : null,
                ]);
            }
            
            // Create siblings (0-3)
            $siblingsCount = $faker->numberBetween(0, 3);
            for ($i = 0; $i < $siblingsCount; $i++) {
                $siblingGender = $faker->randomElement(['male', 'female']);
                
                FamilyMember::create([
                    'employee_id' => $employee->id,
                    'full_name' => $faker->name($siblingGender),
                    'relationship' => 'sibling',
                    'identity_number' => $faker->unique()->numerify('################'),
                    'birth_date' => $faker->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'),
                    'gender' => $siblingGender,
                    'occupation' => $faker->randomElement($occupations),
                    'education_level' => $faker->randomElement($educationLevels),
                    'is_dependent' => false,
                    'is_emergency_contact' => $faker->boolean(70),
                    'phone_number' => $faker->phoneNumber,
                    'address' => $faker->boolean(30) ? $employee->address : $faker->address,
                    'notes' => $faker->boolean(20) ? $faker->sentence : null,
                ]);
            }
        }
    }
}
