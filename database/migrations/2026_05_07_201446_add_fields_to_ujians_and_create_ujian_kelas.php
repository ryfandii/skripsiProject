<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── 1. Tambah kolom ke tabel ujians ──────────────────────────────
        Schema::table('ujians', function (Blueprint $table) {
            // mapel_id: guru mengajar mapel apa
            if (!Schema::hasColumn('ujians', 'mapel_id')) {
                $table->unsignedBigInteger('mapel_id')->nullable()->after('guru_id');
            }
            // jenis: UTS atau UAS
            if (!Schema::hasColumn('ujians', 'jenis')) {
                $table->enum('jenis', ['UTS', 'UAS'])->default('UTS')->after('mapel_id');
            }
            // status_kirim: draft = belum dikirim ke siswa, terkirim = sudah dikirim
            if (!Schema::hasColumn('ujians', 'status_kirim')) {
                $table->enum('status_kirim', ['draft', 'terkirim'])->default('draft')->after('jenis');
            }
        });

        // ── 2. Buat tabel pivot ujian_kelas ──────────────────────────────
        // Satu ujian bisa dikirim ke BANYAK kelas sekaligus
        if (!Schema::hasTable('ujian_kelas')) {
            Schema::create('ujian_kelas', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('ujian_id');
                $table->unsignedBigInteger('kelas_id');
                $table->timestamps();

                // Satu ujian tidak boleh duplikat ke kelas yang sama
                $table->unique(['ujian_id', 'kelas_id']);

                $table->foreign('ujian_id')->references('id')->on('ujians')->onDelete('cascade');
                $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::table('ujians', function (Blueprint $table) {
            $table->dropColumn(['mapel_id', 'jenis', 'status_kirim']);
        });

        Schema::dropIfExists('ujian_kelas');
    }
};