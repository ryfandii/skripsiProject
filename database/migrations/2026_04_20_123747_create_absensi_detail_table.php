<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
       Schema::create('absensi_detail', function (Blueprint $table) {
            $table->id();

            $table->foreignId('absensi_id')->constrained('absensi')->cascadeOnDelete();
            $table->foreignId('siswa_id')->constrained()->cascadeOnDelete();

            $table->enum('status', ['hadir', 'izin', 'sakit', 'alpha'])->default('hadir');

            $table->text('keterangan')->nullable(); // 🔥 WAJIB

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensi_detail');
    }
};
