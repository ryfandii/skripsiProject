<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';

    protected $fillable = [
        'siswa_id',
        'mapel_id',

        // 🔥 lama (jangan dihapus dulu)
        'nilai',

        // 🔥 baru
        'nilai_tugas',
        'nilai_uts',
        'nilai_uas'
    ];

    public function siswa()
    {
        return $this->belongsTo(\App\Models\Siswa::class);
    }

    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class, 'mapel_id');
    }

    // 🔥 helper biar fleksibel (INI KUNCI AMAN)
    public function getNilaiAkhirAttribute()
    {
        // kalau pakai sistem baru
        if ($this->nilai_tugas || $this->nilai_uts || $this->nilai_uas) {
            return collect([
                $this->nilai_tugas,
                $this->nilai_uts,
                $this->nilai_uas
            ])->filter()->avg();
        }

        // fallback ke sistem lama
        return $this->nilai;
    }
}