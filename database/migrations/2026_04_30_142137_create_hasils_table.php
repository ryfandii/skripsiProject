<?php

// database/migrations/xxxx_xx_xx_create_hasils_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('hasils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('ujian_id')->constrained('ujians')->cascadeOnDelete();
            $table->unsignedInteger('nilai');
            $table->timestamps();

            $table->unique(['user_id','ujian_id']); // 1 hasil per ujian
        });
    }
    public function down(): void {
        Schema::dropIfExists('hasils');
    }
};
