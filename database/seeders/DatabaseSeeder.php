<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            DepartmentSeeder::class,
            PositionSeeder::class,
            UnitSeeder::class,
            RankClassSeeder::class,
            EmployeeSeeder::class,
            EducationSeeder::class,
            WorkExperienceSeeder::class,
            DocumentSeeder::class,
            FamilyMemberSeeder::class,
            SkillSeeder::class,
        ]);
    }
}
