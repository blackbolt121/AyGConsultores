<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_cycle_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_cycle_id')->constrained('course_cycles')->cascadeOnDelete();
            $table->foreignId('course_content_id')->constrained('course_contents')->cascadeOnDelete();

            $table->string('content_type', 20)->nullable(); // pdf|video|text|quiz
            $table->longText('body')->nullable();
            $table->string('file_path')->nullable();

            $table->timestamps();

            $table->unique(['course_cycle_id', 'course_content_id'], 'cycle_material_unique');
            $table->index(['course_cycle_id', 'course_content_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_cycle_materials');
    }
};
