<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->foreignId('course_cycle_id')
                ->nullable()
                ->after('course_id')
                ->constrained('course_cycles')
                ->cascadeOnDelete();

            $table->timestamp('accredited_at')->nullable()->after('expires_at');

            $table->index(['user_id', 'course_cycle_id']);
        });

        // Backfill: create a default cycle per course with existing enrollments.
        $courseIds = DB::table('enrollments')
            ->whereNotNull('course_id')
            ->select('course_id')
            ->distinct()
            ->pluck('course_id');

        foreach ($courseIds as $courseId) {
            $cycleId = DB::table('course_cycles')
                ->where('course_id', $courseId)
                ->where('name', 'Ciclo Default')
                ->value('id');

            if (!$cycleId) {
                $cycleId = DB::table('course_cycles')->insertGetId([
                    'course_id' => $courseId,
                    'name' => 'Ciclo Default',
                    'status' => 'active',
                    'capacity' => 0,
                    'starts_at' => null,
                    'ends_at' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::table('enrollments')
                ->where('course_id', $courseId)
                ->whereNull('course_cycle_id')
                ->update(['course_cycle_id' => $cycleId]);
        }

        Schema::table('enrollments', function (Blueprint $table) {
            $table->unique(['user_id', 'course_cycle_id'], 'enrollments_user_cycle_unique');
        });
    }

    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropUnique('enrollments_user_cycle_unique');
            $table->dropIndex(['user_id', 'course_cycle_id']);
            $table->dropConstrainedForeignId('course_cycle_id');
            $table->dropColumn('accredited_at');
        });
    }
};
