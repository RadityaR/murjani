<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Document;
use App\Models\Employee;
use App\Models\User;
use Faker\Factory as Faker;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
        // Get all employees
        $employees = Employee::all();
        
        // Get admin and manager users for document review
        $reviewers = User::whereIn('role', ['admin', 'manager'])->get();
        
        // Document types
        $documentTypes = [
            'identity_card',
            'certificate',
            'diploma',
            'resume',
            'photo',
            'license',
            'contract',
            'other'
        ];
        
        // MIME types
        $mimeTypes = [
            'application/pdf',
            'image/jpeg',
            'image/png',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ];
        
        // For each employee, create 2-5 documents
        foreach ($employees as $employee) {
            $documentCount = $faker->numberBetween(2, 5);
            
            for ($i = 0; $i < $documentCount; $i++) {
                $documentType = $faker->randomElement($documentTypes);
                $mimeType = $faker->randomElement($mimeTypes);
                $extension = '';
                
                // Set extension based on mime type
                switch ($mimeType) {
                    case 'application/pdf':
                        $extension = '.pdf';
                        break;
                    case 'image/jpeg':
                        $extension = '.jpg';
                        break;
                    case 'image/png':
                        $extension = '.png';
                        break;
                    case 'application/msword':
                        $extension = '.doc';
                        break;
                    case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                        $extension = '.docx';
                        break;
                }
                
                // Generate original filename
                $originalFilename = $documentType . '_' . $faker->word . $extension;
                
                // Generate system filename
                $filename = $employee->id . '_' . $documentType . '_' . time() . '_' . $faker->randomNumber(5) . $extension;
                
                // Generate file path
                $filePath = 'documents/' . $employee->id . '/' . $filename;
                
                // Determine status
                $status = $faker->randomElement(['pending', 'approved', 'rejected']);
                
                // Create document
                $document = [
                    'employee_id' => $employee->id,
                    'uploaded_by' => $faker->randomElement($reviewers)->id,
                    'filename' => $filename,
                    'original_filename' => $originalFilename,
                    'file_path' => $filePath,
                    'mime_type' => $mimeType,
                    'file_size' => $faker->numberBetween(10000, 5000000), // 10KB to 5MB
                    'document_type' => $documentType,
                    'description' => $faker->sentence,
                    'status' => $status,
                    'review_notes' => ($status !== 'pending') ? $faker->paragraph : null,
                    'reviewed_at' => ($status !== 'pending') ? $faker->dateTimeBetween('-1 year', 'now') : null,
                    'reviewed_by' => ($status !== 'pending') ? $faker->randomElement($reviewers)->id : null,
                ];
                
                Document::create($document);
            }
        }
    }
}
