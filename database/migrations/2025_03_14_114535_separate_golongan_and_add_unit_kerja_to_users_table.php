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
        Schema::table('users', function (Blueprint $table) {
            // Add new columns
            $table->string('jabatan')->nullable()->after('golongan');
            $table->string('unit_kerja')->nullable()->after('jabatan');
            
            // Rename existing column to be more specific
            $table->renameColumn('golongan', 'golongan_pangkat');
        });
        
        // Migrate existing data
        DB::table('users')->get()->each(function ($user) {
            if ($user->golongan_pangkat) {
                $parts = explode(' - ', $user->golongan_pangkat);
                
                $golongan = $parts[0] ?? null;
                $jabatan = $parts[1] ?? null;
                $unitKerja = $parts[2] ?? null;
                
                DB::table('users')
                    ->where('id', $user->id)
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
        Schema::table('users', function (Blueprint $table) {
            // Combine data back before dropping columns
            DB::table('users')->get()->each(function ($user) {
                $combined = trim(implode(' - ', array_filter([
                    $user->golongan_pangkat,
                    $user->jabatan,
                    $user->unit_kerja
                ])));
                
                if ($combined) {
                    DB::table('users')
                        ->where('id', $user->id)
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
