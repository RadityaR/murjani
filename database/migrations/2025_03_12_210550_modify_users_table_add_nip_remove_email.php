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
        Schema::table('users', function (Blueprint $table) {
            // Only add nip column if it doesn't already exist
            if (!Schema::hasColumn('users', 'nip')) {
                $table->string('nip')->unique()->after('id');
            }
            
            // Only drop these columns if they exist
            if (Schema::hasColumn('users', 'email')) {
                $table->dropColumn('email');
            }
            
            if (Schema::hasColumn('users', 'email_verified_at')) {
                $table->dropColumn('email_verified_at');
            }
            
            if (Schema::hasColumn('users', 'remember_token')) {
                $table->dropColumn('remember_token');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'nip')) {
                $table->dropColumn('nip');
            }
            
            if (!Schema::hasColumn('users', 'email')) {
                $table->string('email')->unique();
            }
            
            if (!Schema::hasColumn('users', 'email_verified_at')) {
                $table->timestamp('email_verified_at')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'remember_token')) {
                $table->rememberToken();
            }
        });
    }
};
