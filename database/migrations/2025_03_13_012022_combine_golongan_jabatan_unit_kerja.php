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
            // First, ensure golongan field is large enough to accommodate combined data
            // Then, remove the unit_kerja field
            $table->string('golongan', 500)->nullable()->change(); // Increase size to accommodate combined data
            $table->dropColumn('unit_kerja');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Add back the unit_kerja field
            $table->string('unit_kerja')->nullable()->after('golongan');
            // Revert golongan field to original size
            $table->string('golongan', 255)->nullable()->change();
        });
    }
};
