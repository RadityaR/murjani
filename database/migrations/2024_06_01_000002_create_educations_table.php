<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['formal', 'informal']);
            $table->string('institution_name');
            $table->enum('level', [
                'SD', 
                'SLTP', 
                'SLTA', 
                'Diploma', 
                'S1', 
                'S2', 
                'S3', 
                'Spesialis',
                'Sub Spesialis'
            ])->nullable(); // For formal education
            $table->string('course_name')->nullable(); // For informal education
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
}; 