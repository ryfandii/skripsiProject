<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    protected $fillable = [
        'judul', 'durasi', 'mulai', 'selesai',
        'guru_id', 'mapel_id', 'jenis', 'status_kirim',
    ];

    // ── Relasi ke banyak kelas (pivot ujian_kelas) ─────────────────────
    // Satu ujian bisa dikirim ke banyak kelas
    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'ujian_kelas', 'ujian_id', 'kelas_id');
    }

    // ── Relasi ke soal ────────────────────────────────────────────────
    public function soals()
    {
        return $this->hasMany(Soal::class, 'ujian_id');
    }

    // ── Relasi ke guru ────────────────────────────────────────────────
    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    // ── Relasi ke mapel ───────────────────────────────────────────────
    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class, 'mapel_id');
    }

    // ── Relasi ke hasil (nilai) ───────────────────────────────────────
    public function hasils()
    {
        return $this->hasMany(Hasil::class, 'ujian_id');
    }
}