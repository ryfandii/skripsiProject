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
        // 🔥 GANTI 'siswas' → 'siswa'
        Schema::table('siswa', function (Blueprint $table) {
            $table->enum('status', ['aktif', 'nonaktif'])
                  ->default('aktif')
                  ->after('telepon'); // opsional (biar rapi)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};