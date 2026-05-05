<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_cycle_teacher', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_cycle_id')->constrained('course_cycles')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['course_cycle_id', 'user_id'], 'cycle_teacher_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_cycle_teacher');
    }
};
