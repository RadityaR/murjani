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

        // Define work experience data by employee ID
        $workExperienceData = [
            1 => [ // Budi Santoso - Software Engineer
                [
                    'company' => 'PT Teknologi Maju',
                    'position' => 'Senior Software Engineer',
                    'start_date' => '2018-03-01',
                    'end_date' => null, // Current job
                    'description' => 'Leading development team in creating enterprise software solutions using Laravel and Vue.js.',
                ],
                [
                    'company' => 'PT Digital Solutions',
                    'position' => 'Software Engineer',
                    'start_date' => '2015-06-01',
                    'end_date' => '2018-02-28',
                    'description' => 'Developed and maintained web applications using Laravel and Vue.js.',
                ],
                [
                    'company' => 'PT Inovasi Digital',
                    'position' => 'Junior Developer',
                    'start_date' => '2013-08-01',
                    'end_date' => '2015-05-31',
                    'description' => 'Assisted in developing web applications and fixing bugs.',
                ],
            ],
            2 => [ // Siti Rahayu - Digital Marketing
                [
                    'company' => 'PT Marketing Global',
                    'position' => 'Digital Marketing Manager',
                    'start_date' => '2019-01-15',
                    'end_date' => null, // Current job
                    'description' => 'Managing digital marketing campaigns and social media strategies for various clients.',
                ],
                [
                    'company' => 'PT Media Kreatif',
                    'position' => 'Marketing Specialist',
                    'start_date' => '2016-08-01',
                    'end_date' => '2018-12-31',
                    'description' => 'Executed marketing campaigns and analyzed market trends.',
                ],
                [
                    'company' => 'PT Advertise Indonesia',
                    'position' => 'Marketing Assistant',
                    'start_date' => '2014-05-01',
                    'end_date' => '2016-07-31',
                    'description' => 'Assisted in creating marketing materials and social media content.',
                ],
            ],
            3 => [ // Ahmad Rizki - Project Manager
                [
                    'company' => 'PT Konstruksi Utama',
                    'position' => 'Project Manager',
                    'start_date' => '2017-04-01',
                    'end_date' => null, // Current job
                    'description' => 'Managing large-scale construction projects and team coordination.',
                ],
                [
                    'company' => 'PT Pembangunan Jaya',
                    'position' => 'Site Engineer',
                    'start_date' => '2014-07-01',
                    'end_date' => '2017-03-31',
                    'description' => 'Supervised construction sites and managed project timelines.',
                ],
                [
                    'company' => 'PT Arsitek Muda',
                    'position' => 'Junior Engineer',
                    'start_date' => '2012-01-01',
                    'end_date' => '2014-06-30',
                    'description' => 'Assisted in designing and planning construction projects.',
                ],
            ],
            4 => [ // Dewi Lestari - Content Writer
                [
                    'company' => 'PT Media Konten',
                    'position' => 'Senior Content Writer',
                    'start_date' => '2020-02-01',
                    'end_date' => null, // Current job
                    'description' => 'Creating high-quality content for various digital platforms and publications.',
                ],
                [
                    'company' => 'PT Publikasi Digital',
                    'position' => 'Content Writer',
                    'start_date' => '2017-09-01',
                    'end_date' => '2020-01-31',
                    'description' => 'Wrote articles, blog posts, and social media content for clients.',
                ],
                [
                    'company' => 'Majalah Lifestyle',
                    'position' => 'Freelance Writer',
                    'start_date' => '2016-01-01',
                    'end_date' => '2017-08-31',
                    'description' => 'Contributed articles on lifestyle, travel, and culture topics.',
                ],
            ],
            5 => [ // Eko Prasetyo - Civil Engineer
                [
                    'company' => 'PT Infrastruktur Nasional',
                    'position' => 'Senior Civil Engineer',
                    'start_date' => '2016-05-01',
                    'end_date' => null, // Current job
                    'description' => 'Leading infrastructure projects including bridges and highways.',
                ],
                [
                    'company' => 'PT Konsultan Teknik',
                    'position' => 'Civil Engineer',
                    'start_date' => '2012-08-01',
                    'end_date' => '2016-04-30',
                    'description' => 'Designed and supervised construction of commercial buildings.',
                ],
                [
                    'company' => 'PT Bangunan Jaya',
                    'position' => 'Junior Engineer',
                    'start_date' => '2010-01-01',
                    'end_date' => '2012-07-31',
                    'description' => 'Assisted in structural analysis and construction supervision.',
                ],
            ],
            6 => [ // Rina Wijaya - Yoga Instructor
                [
                    'company' => 'Yoga Harmony Studio',
                    'position' => 'Lead Yoga Instructor',
                    'start_date' => '2019-03-01',
                    'end_date' => null, // Current job
                    'description' => 'Teaching various yoga classes and training new instructors.',
                ],
                [
                    'company' => 'Wellness Center Jakarta',
                    'position' => 'Yoga Instructor',
                    'start_date' => '2016-11-01',
                    'end_date' => '2019-02-28',
                    'description' => 'Conducted yoga classes for different skill levels and age groups.',
                ],
                [
                    'company' => 'PT Kesehatan Holistik',
                    'position' => 'Wellness Consultant',
                    'start_date' => '2014-04-01',
                    'end_date' => '2016-10-31',
                    'description' => 'Provided wellness consultations and organized health workshops.',
                ],
            ],
            7 => [ // Hendra Gunawan - Music Producer
                [
                    'company' => 'Studio Musik Indonesia',
                    'position' => 'Music Producer',
                    'start_date' => '2018-01-01',
                    'end_date' => null, // Current job
                    'description' => 'Producing music for various artists and commercial projects.',
                ],
                [
                    'company' => 'PT Rekaman Suara',
                    'position' => 'Sound Engineer',
                    'start_date' => '2015-06-01',
                    'end_date' => '2017-12-31',
                    'description' => 'Managed sound recording and mixing for music productions.',
                ],
                [
                    'company' => 'Radio Musik FM',
                    'position' => 'Audio Technician',
                    'start_date' => '2012-09-01',
                    'end_date' => '2015-05-31',
                    'description' => 'Handled audio equipment and sound quality for radio broadcasts.',
                ],
            ],
            8 => [ // Maya Sari - Artist
                [
                    'company' => 'Galeri Seni Modern',
                    'position' => 'Resident Artist',
                    'start_date' => '2020-07-01',
                    'end_date' => null, // Current job
                    'description' => 'Creating original artwork and conducting art workshops.',
                ],
                [
                    'company' => 'PT Desain Kreatif',
                    'position' => 'Graphic Designer',
                    'start_date' => '2017-03-01',
                    'end_date' => '2020-06-30',
                    'description' => 'Designed visual materials for marketing campaigns and branding.',
                ],
                [
                    'company' => 'Sekolah Seni Rupa',
                    'position' => 'Art Teacher',
                    'start_date' => '2015-08-01',
                    'end_date' => '2017-02-28',
                    'description' => 'Taught painting and drawing techniques to students of various ages.',
                ],
            ],
            9 => [ // Doni Kusuma - Data Scientist
                [
                    'company' => 'PT Analitika Data',
                    'position' => 'Senior Data Scientist',
                    'start_date' => '2019-09-01',
                    'end_date' => null, // Current job
                    'description' => 'Leading data analysis projects and developing machine learning models.',
                ],
                [
                    'company' => 'PT Teknologi Informasi',
                    'position' => 'Data Analyst',
                    'start_date' => '2016-05-01',
                    'end_date' => '2019-08-31',
                    'description' => 'Analyzed business data and created reports for decision-making.',
                ],
                [
                    'company' => 'Bank Nasional Indonesia',
                    'position' => 'Business Intelligence Analyst',
                    'start_date' => '2014-01-01',
                    'end_date' => '2016-04-30',
                    'description' => 'Developed dashboards and reports for financial performance monitoring.',
                ],
            ],
            10 => [ // Anita Permata - Dancer/Photographer
                [
                    'company' => 'Studio Fotografi Bali',
                    'position' => 'Professional Photographer',
                    'start_date' => '2021-01-01',
                    'end_date' => null, // Current job
                    'description' => 'Specializing in cultural and tourism photography across Bali.',
                ],
                [
                    'company' => 'Sanggar Tari Bali',
                    'position' => 'Dance Instructor',
                    'start_date' => '2018-06-01',
                    'end_date' => '2020-12-31',
                    'description' => 'Taught traditional Balinese dance to locals and tourists.',
                ],
                [
                    'company' => 'Hotel Bali Paradise',
                    'position' => 'Cultural Performance Coordinator',
                    'start_date' => '2016-03-01',
                    'end_date' => '2018-05-31',
                    'description' => 'Organized cultural performances and activities for hotel guests.',
                ],
            ],
        ];

        foreach ($employees as $employee) {
            if (isset($workExperienceData[$employee->id])) {
                foreach ($workExperienceData[$employee->id] as $experience) {
                    WorkExperience::create([
                        'employee_id' => $employee->id,
                        'company' => $experience['company'],
                        'position' => $experience['position'],
                        'start_date' => $experience['start_date'],
                        'end_date' => $experience['end_date'],
                        'description' => $experience['description'],
                    ]);
                }
            }
        }
    }
} 