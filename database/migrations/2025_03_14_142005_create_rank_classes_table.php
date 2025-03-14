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
        Schema::create('rank_classes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('Golongan/Pangkat name');
            $table->string('code')->unique();
            $table->integer('level')->comment('Hierarchical level, higher means more senior');
            $table->text('description')->nullable();
            $table->decimal('salary_multiplier', 5, 2)->default(1.00)->comment('Base salary multiplier');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            
            // Add indexes
            $table->index('is_active');
            $table->index('level');
        });
        
        // Modify employees table to use rank_class_id instead of rank_class string
        Schema::table('employees', function (Blueprint $table) {
            // First create the new column
            $table->foreignId('rank_class_id')->nullable()->after('unit_id');
            
            // Remove the old column
            $table->dropColumn('rank_class');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Restore the original column in employees table
        Schema::table('employees', function (Blueprint $table) {
            $table->string('rank_class')->nullable()->after('unit_id')->comment('Golongan/Pangkat');
            $table->dropColumn('rank_class_id');
        });
        
        Schema::dropIfExists('rank_classes');
    }
};
