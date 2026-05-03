<?php

// database/migrations/xxxx_xx_xx_create_soals_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('soals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ujian_id')->constrained('ujians')->cascadeOnDelete();
            $table->text('pertanyaan');
            $table->string('a');
            $table->string('b');
            $table->string('c');
            $table->string('d');
            $table->enum('jawaban_benar', ['a','b','c','d']);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('soals');
    }
};
