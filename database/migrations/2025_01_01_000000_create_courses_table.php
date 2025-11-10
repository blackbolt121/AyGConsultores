<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category');       // liderazgo, desarrollo-personal, etc.
            $table->index('category');
            $table->unsignedSmallInteger('hours')->default(0);
            $table->string('image')->nullable(); // nombre de archivo en /public/images o URL
            $table->text('excerpt')->nullable();
            $table->boolean('featured')->default(false);
            $table->timestamps();
        });
    }

};
