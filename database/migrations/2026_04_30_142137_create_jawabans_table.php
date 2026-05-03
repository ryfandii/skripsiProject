<?php

// database/migrations/xxxx_xx_xx_create_jawabans_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('jawabans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('soal_id')->constrained('soals')->cascadeOnDelete();
            $table->enum('jawaban', ['a','b','c','d'])->nullable();
            $table->timestamps();

            $table->unique(['user_id','soal_id']); // 1 siswa 1 jawaban/soal
        });
    }
    public function down(): void {
        Schema::dropIfExists('jawabans');
    }
};
