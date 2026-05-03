<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengumpulan_tugas', function (Blueprint $table) {
    $table->id();
    $table->foreignId('tugas_id')->constrained()->cascadeOnDelete();
    $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
    $table->string('file')->nullable();
    $table->integer('nilai')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumpulan_tugas');
    }
};
