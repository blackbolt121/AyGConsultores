<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('contact', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('email', 320);
            $table->string('phone', 32);
            $table->string('subject', 255);
            $table->longText('message');
            $table->string('status', 50)->default('new');
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down(): void {
        Schema::dropIfExists('contact');
    }
};
