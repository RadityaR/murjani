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
            $table->enum('education_type', ['formal', 'informal', 'certification']);
            $table->string('institution_name');
            $table->enum('education_level', [
                'elementary', 
                'junior_high', 
                'high_school', 
                'diploma', 
                'bachelor', 
                'master', 
                'doctorate', 
                'specialist', 
                'sub_specialist'
            ])->nullable();
            $table->string('major')->nullable();
            $table->string('degree')->nullable();
            $table->year('start_year')->nullable();
            $table->year('graduation_year')->nullable();
            $table->decimal('gpa', 3, 2)->nullable();
            $table->string('certificate_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Add indexes
            $table->index('education_type');
            $table->index('education_level');
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
