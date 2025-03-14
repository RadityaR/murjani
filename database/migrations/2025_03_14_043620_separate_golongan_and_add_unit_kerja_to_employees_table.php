<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Add new columns
            $table->string('jabatan')->nullable()->after('golongan');
            $table->string('unit_kerja')->nullable()->after('jabatan');
            
            // Rename existing column to be more specific
            $table->renameColumn('golongan', 'golongan_pangkat');
        });
        
        // Migrate existing data
        DB::table('employees')->get()->each(function ($employee) {
            if ($employee->golongan_pangkat) {
                $parts = explode(' - ', $employee->golongan_pangkat);
                
                $golongan = $parts[0] ?? null;
                $jabatan = $parts[1] ?? null;
                $unitKerja = $parts[2] ?? null;
                
                DB::table('employees')
                    ->where('id', $employee->id)
                    ->update([
                        'golongan_pangkat' => $golongan,
                        'jabatan' => $jabatan,
                        'unit_kerja' => $unitKerja,
                    ]);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Combine data back before dropping columns
            DB::table('employees')->get()->each(function ($employee) {
                $combined = trim(implode(' - ', array_filter([
                    $employee->golongan_pangkat,
                    $employee->jabatan,
                    $employee->unit_kerja
                ])));
                
                if ($combined) {
                    DB::table('employees')
                        ->where('id', $employee->id)
                        ->update(['golongan_pangkat' => $combined]);
                }
            });
            
            // Drop new columns
            $table->dropColumn(['jabatan', 'unit_kerja']);
            
            // Rename column back to original name
            $table->renameColumn('golongan_pangkat', 'golongan');
        });
    }
};
