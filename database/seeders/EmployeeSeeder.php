<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\User;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
        // Get existing users
        $users = User::all();
        
        // Create employees for existing users
        foreach ($users as $index => $user) {
            // Skip the first 3 users (admin, manager, user)
            if ($index < 3) {
                continue;
            }
            
            Employee::create([
                'user_id' => $user->id,
                'nip' => $faker->unique()->numerify('19########'),
                'full_name' => $faker->name,
                'identity_number' => $faker->unique()->numerify('################'),
                'position_id' => $faker->numberBetween(7, 23), // Manager and staff positions
                'department_id' => $faker->numberBetween(1, 13),
                'unit_id' => $faker->numberBetween(1, 17),
                'rank_class_id' => $faker->numberBetween(1, 17),
                'employment_status' => $faker->randomElement(['contract', 'civil_servant', 'temporary']),
                'license_status' => $faker->randomElement(['active', 'expired', 'none']),
                'address' => $faker->address,
                'phone_number' => $faker->phoneNumber,
                'birth_date' => $faker->dateTimeBetween('-60 years', '-20 years')->format('Y-m-d'),
                'gender' => $faker->randomElement(['male', 'female']),
                'marital_status' => $faker->randomElement(['single', 'married', 'widowed', 'divorced']),
                'height_cm' => $faker->numberBetween(150, 190),
                'weight_kg' => $faker->numberBetween(45, 100),
                'blood_type' => $faker->randomElement(['A', 'B', 'AB', 'O']),
                'religion' => $faker->randomElement(['Islam', 'Christianity', 'Catholicism', 'Hinduism', 'Buddhism', 'Confucianism']),
                'hobbies' => $faker->randomElement(['Reading', 'Sports', 'Music', 'Traveling', 'Cooking', 'Photography']),
            ]);
        }
        
        // Create additional employees without user accounts
        for ($i = 0; $i < 20; $i++) {
            Employee::create([
                'user_id' => null,
                'nip' => $faker->unique()->numerify('20########'),
                'full_name' => $faker->name,
                'identity_number' => $faker->unique()->numerify('################'),
                'position_id' => $faker->numberBetween(7, 23), // Manager and staff positions
                'department_id' => $faker->numberBetween(1, 13),
                'unit_id' => $faker->numberBetween(1, 17),
                'rank_class_id' => $faker->numberBetween(1, 17),
                'employment_status' => $faker->randomElement(['contract', 'civil_servant', 'temporary']),
                'license_status' => $faker->randomElement(['active', 'expired', 'none']),
                'address' => $faker->address,
                'phone_number' => $faker->phoneNumber,
                'birth_date' => $faker->dateTimeBetween('-60 years', '-20 years')->format('Y-m-d'),
                'gender' => $faker->randomElement(['male', 'female']),
                'marital_status' => $faker->randomElement(['single', 'married', 'widowed', 'divorced']),
                'height_cm' => $faker->numberBetween(150, 190),
                'weight_kg' => $faker->numberBetween(45, 100),
                'blood_type' => $faker->randomElement(['A', 'B', 'AB', 'O']),
                'religion' => $faker->randomElement(['Islam', 'Christianity', 'Catholicism', 'Hinduism', 'Buddhism', 'Confucianism']),
                'hobbies' => $faker->randomElement(['Reading', 'Sports', 'Music', 'Traveling', 'Cooking', 'Photography']),
            ]);
        }
    }
}
