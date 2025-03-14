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
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('code')->unique()->nullable();
            $table->text('description')->nullable();
            $table->foreignId('department_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('level')->default(0)->comment('Hierarchical level, higher means more senior');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            
            // Add indexes
            $table->index('is_active');
            $table->index('level');
        });
        
        // Modify employees table to use position_id instead of position string
        Schema::table('employees', function (Blueprint $table) {
            // First create the new column
            $table->foreignId('position_id')->nullable()->after('department_id');
            
            // Remove the old column
            $table->dropColumn('position');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Restore the original column in employees table
        Schema::table('employees', function (Blueprint $table) {
            $table->string('position')->nullable()->after('department_id');
            $table->dropColumn('position_id');
        });
        
        Schema::dropIfExists('positions');
    }
};
