<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('course_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('course_contents')->cascadeOnDelete();

            $table->string('type', 32)->default('section');
            $table->string('title', 200);
            $table->string('slug', 220)->nullable();
            $table->text('summary')->nullable();
            $table->longText('body')->nullable();
            $table->unsignedInteger('sort_order')->default(1);

            $table->timestamps();

            $table->index(['course_id', 'parent_id']);
            $table->index(['course_id', 'sort_order']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('course_contents');
    }
};
