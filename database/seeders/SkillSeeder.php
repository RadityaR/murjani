<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Skill;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
        // Skill categories
        $skillCategories = [
            'Technical',
            'Soft Skills',
            'Language',
            'Management',
            'Leadership',
            'Computer',
            'Medical',
            'Administrative',
            'Financial',
            'Legal',
        ];
        
        // Technical skills
        $technicalSkills = [
            'Programming',
            'Database Management',
            'Network Administration',
            'System Administration',
            'Web Development',
            'Mobile Development',
            'Data Analysis',
            'Machine Learning',
            'Artificial Intelligence',
            'Cloud Computing',
            'DevOps',
            'Cybersecurity',
            'Technical Writing',
            'Quality Assurance',
            'UI/UX Design',
        ];
        
        // Soft skills
        $softSkills = [
            'Communication',
            'Teamwork',
            'Problem Solving',
            'Critical Thinking',
            'Time Management',
            'Adaptability',
            'Creativity',
            'Emotional Intelligence',
            'Conflict Resolution',
            'Negotiation',
            'Presentation',
            'Public Speaking',
            'Customer Service',
            'Interpersonal Skills',
            'Work Ethic',
        ];
        
        // Language skills
        $languageSkills = [
            'English',
            'Indonesian',
            'Javanese',
            'Sundanese',
            'Batak',
            'Minangkabau',
            'Balinese',
            'Buginese',
            'Acehnese',
            'Arabic',
            'Mandarin',
            'Japanese',
            'Korean',
            'German',
            'French',
        ];
        
        // Management skills
        $managementSkills = [
            'Project Management',
            'Team Management',
            'Resource Management',
            'Risk Management',
            'Change Management',
            'Strategic Planning',
            'Budgeting',
            'Performance Management',
            'Process Improvement',
            'Quality Management',
            'Supply Chain Management',
            'Operations Management',
            'Product Management',
            'Customer Relationship Management',
            'Stakeholder Management',
        ];
        
        // Create technical skills
        foreach ($technicalSkills as $skill) {
            Skill::create([
                'name' => $skill,
                'category' => 'Technical',
                'description' => $faker->sentence,
                'is_active' => true,
            ]);
        }
        
        // Create soft skills
        foreach ($softSkills as $skill) {
            Skill::create([
                'name' => $skill,
                'category' => 'Soft Skills',
                'description' => $faker->sentence,
                'is_active' => true,
            ]);
        }
        
        // Create language skills
        foreach ($languageSkills as $skill) {
            Skill::create([
                'name' => $skill,
                'category' => 'Language',
                'description' => $faker->sentence,
                'is_active' => true,
            ]);
        }
        
        // Create management skills
        foreach ($managementSkills as $skill) {
            Skill::create([
                'name' => $skill,
                'category' => 'Management',
                'description' => $faker->sentence,
                'is_active' => true,
            ]);
        }
        
        // Get all employees and skills
        $employees = Employee::all();
        $skills = Skill::all();
        $skillCount = $skills->count();
        
        // For each employee, assign 3-10 random skills
        foreach ($employees as $employee) {
            $assignedSkillCount = $faker->numberBetween(3, 10);
            $assignedSkillIds = $faker->randomElements($skills->pluck('id')->toArray(), $assignedSkillCount);
            
            foreach ($assignedSkillIds as $skillId) {
                DB::table('employee_skill')->insert([
                    'employee_id' => $employee->id,
                    'skill_id' => $skillId,
                    'proficiency_level' => $faker->randomElement(['beginner', 'intermediate', 'advanced', 'expert']),
                    'notes' => $faker->boolean(30) ? $faker->sentence : null,
                    'acquired_date' => $faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d'),
                    'last_used_date' => $faker->boolean(70) ? $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d') : null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
