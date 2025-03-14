<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RankClass;

class RankClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Indonesian civil servant rank classes (Golongan/Pangkat)
        $rankClasses = [
            // Golongan I
            [
                'name' => 'Juru Muda',
                'code' => 'I/a',
                'level' => 1,
                'description' => 'Golongan I/a',
                'salary_multiplier' => 1.00,
                'is_active' => true,
            ],
            [
                'name' => 'Juru Muda Tingkat I',
                'code' => 'I/b',
                'level' => 2,
                'description' => 'Golongan I/b',
                'salary_multiplier' => 1.05,
                'is_active' => true,
            ],
            [
                'name' => 'Juru',
                'code' => 'I/c',
                'level' => 3,
                'description' => 'Golongan I/c',
                'salary_multiplier' => 1.10,
                'is_active' => true,
            ],
            [
                'name' => 'Juru Tingkat I',
                'code' => 'I/d',
                'level' => 4,
                'description' => 'Golongan I/d',
                'salary_multiplier' => 1.15,
                'is_active' => true,
            ],
            
            // Golongan II
            [
                'name' => 'Pengatur Muda',
                'code' => 'II/a',
                'level' => 5,
                'description' => 'Golongan II/a',
                'salary_multiplier' => 1.20,
                'is_active' => true,
            ],
            [
                'name' => 'Pengatur Muda Tingkat I',
                'code' => 'II/b',
                'level' => 6,
                'description' => 'Golongan II/b',
                'salary_multiplier' => 1.25,
                'is_active' => true,
            ],
            [
                'name' => 'Pengatur',
                'code' => 'II/c',
                'level' => 7,
                'description' => 'Golongan II/c',
                'salary_multiplier' => 1.30,
                'is_active' => true,
            ],
            [
                'name' => 'Pengatur Tingkat I',
                'code' => 'II/d',
                'level' => 8,
                'description' => 'Golongan II/d',
                'salary_multiplier' => 1.35,
                'is_active' => true,
            ],
            
            // Golongan III
            [
                'name' => 'Penata Muda',
                'code' => 'III/a',
                'level' => 9,
                'description' => 'Golongan III/a',
                'salary_multiplier' => 1.40,
                'is_active' => true,
            ],
            [
                'name' => 'Penata Muda Tingkat I',
                'code' => 'III/b',
                'level' => 10,
                'description' => 'Golongan III/b',
                'salary_multiplier' => 1.45,
                'is_active' => true,
            ],
            [
                'name' => 'Penata',
                'code' => 'III/c',
                'level' => 11,
                'description' => 'Golongan III/c',
                'salary_multiplier' => 1.50,
                'is_active' => true,
            ],
            [
                'name' => 'Penata Tingkat I',
                'code' => 'III/d',
                'level' => 12,
                'description' => 'Golongan III/d',
                'salary_multiplier' => 1.55,
                'is_active' => true,
            ],
            
            // Golongan IV
            [
                'name' => 'Pembina',
                'code' => 'IV/a',
                'level' => 13,
                'description' => 'Golongan IV/a',
                'salary_multiplier' => 1.60,
                'is_active' => true,
            ],
            [
                'name' => 'Pembina Tingkat I',
                'code' => 'IV/b',
                'level' => 14,
                'description' => 'Golongan IV/b',
                'salary_multiplier' => 1.65,
                'is_active' => true,
            ],
            [
                'name' => 'Pembina Utama Muda',
                'code' => 'IV/c',
                'level' => 15,
                'description' => 'Golongan IV/c',
                'salary_multiplier' => 1.70,
                'is_active' => true,
            ],
            [
                'name' => 'Pembina Utama Madya',
                'code' => 'IV/d',
                'level' => 16,
                'description' => 'Golongan IV/d',
                'salary_multiplier' => 1.75,
                'is_active' => true,
            ],
            [
                'name' => 'Pembina Utama',
                'code' => 'IV/e',
                'level' => 17,
                'description' => 'Golongan IV/e',
                'salary_multiplier' => 1.80,
                'is_active' => true,
            ],
        ];

        // Insert rank classes
        foreach ($rankClasses as $rankClass) {
            RankClass::create($rankClass);
        }
    }
}
