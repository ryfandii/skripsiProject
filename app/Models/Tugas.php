<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\PengumpulanTugas;

class Tugas extends Model
{
    protected $fillable = [
    'guru_id',
    'kelas_id',
    'mapel_id',
    'judul',
    'deskripsi',
    'file', // 🔥 WAJIB ADA
    'deadline'
];

    // RELASI
   public function kelas()
{
    return $this->belongsTo(Kelas::class, 'kelas_id'); // 🔥 WAJIB ADA INI
}

public function mapel()
{
    return $this->belongsTo(\App\Models\MataPelajaran::class, 'mapel_id');
}

public function guru()
{
    return $this->belongsTo(Guru::class, 'guru_id');
}

    public function pengumpulan()
{
    return $this->hasMany(\App\Models\PengumpulanTugas::class, 'tugas_id');
}
}