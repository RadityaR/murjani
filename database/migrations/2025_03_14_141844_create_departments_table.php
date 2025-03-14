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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('code')->unique()->nullable();
            $table->text('description')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('departments')->onDelete('set null');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            
            // Add indexes
            $table->index('is_active');
        });
        
        // Modify employees table to use department_id instead of department string
        Schema::table('employees', function (Blueprint $table) {
            // First create the new column
            $table->foreignId('department_id')->nullable()->after('unit');
            
            // Remove the old column
            $table->dropColumn('department');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Restore the original column in employees table
        Schema::table('employees', function (Blueprint $table) {
            $table->string('department')->nullable()->after('unit');
            $table->dropColumn('department_id');
        });
        
        Schema::dropIfExists('departments');
    }
};
