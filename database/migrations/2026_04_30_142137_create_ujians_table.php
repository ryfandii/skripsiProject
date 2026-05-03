<?php

// database/migrations/xxxx_xx_xx_create_ujians_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ujians', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->foreignId('guru_id')->constrained('users')->cascadeOnDelete();
            $table->unsignedInteger('durasi')->nullable(); // menit
            $table->timestamp('mulai')->nullable();
            $table->timestamp('selesai')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('ujians');
    }
};
