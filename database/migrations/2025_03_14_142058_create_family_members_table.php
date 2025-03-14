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
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->string('full_name');
            $table->enum('relationship', [
                'spouse',
                'child',
                'parent',
                'sibling',
                'other'
            ]);
            $table->string('identity_number')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('occupation')->nullable();
            $table->string('education_level')->nullable();
            $table->boolean('is_dependent')->default(false);
            $table->boolean('is_emergency_contact')->default(false);
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Add indexes
            $table->index('relationship');
            $table->index('is_dependent');
            $table->index('is_emergency_contact');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_members');
    }
};
