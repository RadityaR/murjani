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
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('roles');
    }

    /**
     * Reverse the migrations.
     * Note: This doesn't recreate the tables with their original structure
     * as this is a simplification migration
     */
    public function down(): void
    {
        // If you need to rollback this migration, you should manually recreate
        // the tables with their original structure
    }
};
