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
            $table->string('name');
            $table->text('address');
            $table->string('phone');
            $table->string('email')->unique();
            $table->date('date_of_birth');
            $table->enum('gender', ['Laki-Laki', 'Perempuan']);
            $table->enum('marital_status', ['Belum Menikah', 'Menikah', 'Duda', 'Janda']);
            $table->unsignedSmallInteger('height_cm'); // e.g., 185 cm
            $table->unsignedSmallInteger('weight_kg'); // e.g., 50 kg
            $table->enum('blood_type', ['A', 'B', 'AB', 'O']);
            $table->string('religion');
            $table->string('hobby');
            $table->timestamps();
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