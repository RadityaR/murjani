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
            $table->string('ktp_number')->nullable()->after('name');
            $table->string('nip')->nullable()->after('ktp_number');
            $table->string('golongan')->nullable()->after('nip');
            $table->enum('employee_status', ['Kontrak', 'PNS', 'PPPK'])->nullable()->after('golongan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn(['ktp_number', 'nip', 'golongan', 'employee_status']);
        });
    }
};
