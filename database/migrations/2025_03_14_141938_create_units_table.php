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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('code')->unique()->nullable();
            $table->text('description')->nullable();
            $table->foreignId('department_id')->nullable()->constrained()->onDelete('set null');
            $table->string('location')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            
            // Add indexes
            $table->index('is_active');
        });
        
        // Modify employees table to use unit_id instead of unit string
        Schema::table('employees', function (Blueprint $table) {
            // First create the new column
            $table->foreignId('unit_id')->nullable()->after('position_id');
            
            // Remove the old column
            $table->dropColumn('unit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Restore the original column in employees table
        Schema::table('employees', function (Blueprint $table) {
            $table->string('unit')->nullable()->after('position_id');
            $table->dropColumn('unit_id');
        });
        
        Schema::dropIfExists('units');
    }
};
