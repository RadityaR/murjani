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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('nip')->unique()->nullable()->comment('National Identity Number for government employees');
            $table->string('full_name');
            $table->string('identity_number')->nullable()->comment('National ID card number');
            $table->string('position')->nullable();
            $table->string('department')->nullable();
            $table->string('unit')->nullable();
            $table->enum('employment_status', ['contract', 'civil_servant', 'temporary'])->nullable();
            $table->enum('license_status', ['active', 'expired', 'none'])->nullable();
            $table->text('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->enum('marital_status', ['single', 'married', 'widowed', 'divorced'])->nullable();
            $table->unsignedSmallInteger('height_cm')->nullable();
            $table->unsignedSmallInteger('weight_kg')->nullable();
            $table->enum('blood_type', ['A', 'B', 'AB', 'O'])->nullable();
            $table->string('religion')->nullable();
            $table->string('hobbies')->nullable();
            $table->string('rank_class')->nullable()->comment('Golongan/Pangkat');
            $table->timestamps();
            $table->softDeletes();
            
            // Add indexes for frequently queried fields
            $table->index('nip');
            $table->index('employment_status');
            $table->index('department');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
