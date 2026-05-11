<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // If a previous attempt failed mid-migration (e.g. long index name on MySQL),
        // ensure we can re-run cleanly.
        Schema::dropIfExists('course_cycle_content_progress');

        Schema::create('course_cycle_content_progress', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_cycle_id')->constrained('course_cycles')->cascadeOnDelete();
            $table->foreignId('course_content_id')->constrained('course_contents')->cascadeOnDelete();

            // Active time accumulated while user is actually viewing (foreground + resumed).
            $table->unsignedInteger('active_seconds')->default(0);
            $table->timestamp('last_heartbeat_at')->nullable();

            $table->timestamp('completed_at')->nullable();

            // PDF tracking (optional)
            $table->unsignedInteger('pdf_total_pages')->nullable();
            $table->timestamp('pdf_reached_last_page_at')->nullable();

            $table->timestamps();

            $table->unique(['user_id', 'course_cycle_id', 'course_content_id'], 'cycle_content_progress_unique');
            $table->index(['course_cycle_id', 'user_id'], 'cccp_cycle_user_idx');
            $table->index(['course_cycle_id', 'course_content_id'], 'cccp_cycle_content_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_cycle_content_progress');
    }
};
