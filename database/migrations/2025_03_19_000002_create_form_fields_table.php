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
        Schema::create('form_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_template_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('key')->comment('Unique field identifier within the form');
            $table->string('label');
            $table->enum('field_type', [
                'text', 'textarea', 'number', 'email', 'password', 'date', 
                'datetime', 'time', 'select', 'multiselect', 'radio', 
                'checkbox', 'file', 'hidden', 'tel', 'url', 'color', 'range'
            ])->default('text');
            $table->text('description')->nullable();
            $table->text('placeholder')->nullable();
            $table->text('help_text')->nullable();
            $table->text('default_value')->nullable();
            $table->json('options')->nullable()->comment('Options for select, radio, checkbox fields');
            $table->json('validation_rules')->nullable()->comment('Laravel validation rules in JSON format');
            $table->boolean('is_required')->default(false);
            $table->boolean('is_unique')->default(false);
            $table->boolean('is_visible')->default(true);
            $table->boolean('is_editable')->default(true);
            $table->integer('min_length')->nullable();
            $table->integer('max_length')->nullable();
            $table->integer('sort_order')->default(0);
            $table->string('section')->nullable()->comment('Group fields into sections');
            $table->string('width')->default('full')->comment('Field width: full, half, third, quarter');
            $table->json('conditional_logic')->nullable()->comment('Show/hide based on other fields');
            $table->timestamps();

            // Add unique constraint for field key within a form template
            $table->unique(['form_template_id', 'key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_fields');
    }
}; 