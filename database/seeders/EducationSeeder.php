<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Education;
use App\Models\Employee;
use Faker\Factory as Faker;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
        // Get all employees
        $employees = Employee::all();
        
        // Indonesian universities
        $universities = [
            'Universitas Indonesia',
            'Institut Teknologi Bandung',
            'Universitas Gadjah Mada',
            'Institut Pertanian Bogor',
            'Universitas Airlangga',
            'Universitas Diponegoro',
            'Universitas Padjadjaran',
            'Universitas Brawijaya',
            'Universitas Hasanuddin',
            'Universitas Sebelas Maret',
            'Universitas Negeri Jakarta',
            'Universitas Negeri Yogyakarta',
            'Universitas Negeri Malang',
            'Universitas Negeri Semarang',
            'Universitas Pendidikan Indonesia',
        ];
        
        // Indonesian high schools
        $highSchools = [
            'SMAN 1 Jakarta',
            'SMAN 2 Bandung',
            'SMAN 3 Surabaya',
            'SMAN 1 Yogyakarta',
            'SMAN 2 Semarang',
            'SMAN 3 Medan',
            'SMAN 1 Makassar',
            'SMAN 2 Palembang',
            'SMAN 3 Denpasar',
            'SMAN 1 Padang',
        ];
        
        // Majors
        $majors = [
            'Computer Science',
            'Information Technology',
            'Accounting',
            'Management',
            'Economics',
            'Law',
            'Medicine',
            'Nursing',
            'Civil Engineering',
            'Mechanical Engineering',
            'Electrical Engineering',
            'Architecture',
            'Psychology',
            'Communication',
            'International Relations',
        ];
        
        // Training institutions
        $trainingInstitutions = [
            'Badan Pengembangan Sumber Daya Manusia',
            'Lembaga Administrasi Negara',
            'Pusat Pendidikan dan Pelatihan Kementerian',
            'Balai Diklat Kementerian',
            'Indonesia Professional Certification Authority',
            'Lembaga Sertifikasi Profesi',
            'Pusat Pengembangan Kompetensi',
            'Balai Pelatihan Teknis',
        ];
        
        // Training courses
        $trainingCourses = [
            'Leadership Training',
            'Management Training',
            'Technical Skills Development',
            'Professional Certification',
            'Soft Skills Development',
            'Language Proficiency',
            'Computer Skills',
            'Project Management',
            'Financial Management',
            'Human Resource Management',
        ];
        
        // For each employee, create 2-4 education records
        foreach ($employees as $employee) {
            // Formal education - High School
            Education::create([
                'employee_id' => $employee->id,
                'education_type' => 'formal',
                'institution_name' => $faker->randomElement($highSchools),
                'education_level' => 'high_school',
                'major' => null,
                'degree' => null,
                'start_year' => $faker->numberBetween(1990, 2010),
                'graduation_year' => $faker->numberBetween(1993, 2013),
                'gpa' => $faker->randomFloat(2, 2.5, 4.0),
                'certificate_number' => $faker->bothify('SMA-####-????'),
            ]);
            
            // Formal education - Bachelor's degree
            Education::create([
                'employee_id' => $employee->id,
                'education_type' => 'formal',
                'institution_name' => $faker->randomElement($universities),
                'education_level' => 'bachelor',
                'major' => $faker->randomElement($majors),
                'degree' => 'S.'.substr($faker->randomElement($majors), 0, 1),
                'start_year' => $faker->numberBetween(1994, 2014),
                'graduation_year' => $faker->numberBetween(1998, 2018),
                'gpa' => $faker->randomFloat(2, 2.5, 4.0),
                'certificate_number' => $faker->bothify('S1-####-????'),
            ]);
            
            // Some employees have master's degree
            if ($faker->boolean(30)) {
                Education::create([
                    'employee_id' => $employee->id,
                    'education_type' => 'formal',
                    'institution_name' => $faker->randomElement($universities),
                    'education_level' => 'master',
                    'major' => $faker->randomElement($majors),
                    'degree' => 'M.'.substr($faker->randomElement($majors), 0, 1),
                    'start_year' => $faker->numberBetween(2000, 2018),
                    'graduation_year' => $faker->numberBetween(2002, 2020),
                    'gpa' => $faker->randomFloat(2, 3.0, 4.0),
                    'certificate_number' => $faker->bothify('S2-####-????'),
                ]);
            }
            
            // Some employees have doctoral degree
            if ($faker->boolean(10)) {
                Education::create([
                    'employee_id' => $employee->id,
                    'education_type' => 'formal',
                    'institution_name' => $faker->randomElement($universities),
                    'education_level' => 'doctorate',
                    'major' => $faker->randomElement($majors),
                    'degree' => 'Dr.',
                    'start_year' => $faker->numberBetween(2005, 2018),
                    'graduation_year' => $faker->numberBetween(2010, 2023),
                    'gpa' => $faker->randomFloat(2, 3.5, 4.0),
                    'certificate_number' => $faker->bothify('S3-####-????'),
                ]);
            }
            
            // Informal education - Training
            $trainingCount = $faker->numberBetween(1, 3);
            for ($i = 0; $i < $trainingCount; $i++) {
                Education::create([
                    'employee_id' => $employee->id,
                    'education_type' => 'informal',
                    'institution_name' => $faker->randomElement($trainingInstitutions),
                    'education_level' => null,
                    'major' => $faker->randomElement($trainingCourses),
                    'degree' => null,
                    'start_year' => $faker->numberBetween(2010, 2023),
                    'graduation_year' => $faker->numberBetween(2010, 2023),
                    'gpa' => null,
                    'certificate_number' => $faker->bothify('TRN-####-????'),
                ]);
            }
            
            // Some employees have certifications
            if ($faker->boolean(40)) {
                Education::create([
                    'employee_id' => $employee->id,
                    'education_type' => 'certification',
                    'institution_name' => $faker->company,
                    'education_level' => null,
                    'major' => $faker->jobTitle,
                    'degree' => null,
                    'start_year' => $faker->numberBetween(2015, 2023),
                    'graduation_year' => $faker->numberBetween(2015, 2023),
                    'gpa' => null,
                    'certificate_number' => $faker->bothify('CERT-####-????'),
                ]);
            }
        }
    }
}
