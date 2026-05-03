<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tugas;
use App\Models\Siswa;

class PengumpulanTugas extends Model
{
    protected $table = 'pengumpulan_tugas';

    protected $fillable = [
    'tugas_id',
    'siswa_id',
    'file',
    'nilai',
    'komentar'
];

// RELASI
public function siswa()
{
    return $this->belongsTo(Siswa::class);
}

public function tugas()
{
    return $this->belongsTo(Tugas::class);
}
}