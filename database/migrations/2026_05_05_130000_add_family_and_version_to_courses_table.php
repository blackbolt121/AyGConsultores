<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->unsignedBigInteger('course_family_id')->nullable()->after('id');
            $table->unsignedInteger('major_version')->default(1)->after('course_family_id');

            $table->index('course_family_id');
        });

        // Backfill: existing courses are their own family, v1.
        DB::statement('UPDATE courses SET course_family_id = id WHERE course_family_id IS NULL');

        Schema::table('courses', function (Blueprint $table) {
            $table->unique(['course_family_id', 'major_version'], 'courses_family_version_unique');
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropUnique('courses_family_version_unique');
            $table->dropIndex(['course_family_id']);
            $table->dropColumn(['course_family_id', 'major_version']);
        });
    }
};
