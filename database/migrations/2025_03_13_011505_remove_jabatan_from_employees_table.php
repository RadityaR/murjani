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
        Schema::table('employees', function (Blueprint $table) {
            // First, update golongan field to include jabatan information
            // Then, remove the jabatan field
            $table->string('golongan', 255)->nullable()->change(); // Increase size to accommodate combined data
            $table->dropColumn('jabatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Add back the jabatan field
            $table->string('jabatan')->nullable()->after('golongan');
            // Revert golongan field to original size
            $table->string('golongan', 10)->nullable()->change();
        });
    }
};
