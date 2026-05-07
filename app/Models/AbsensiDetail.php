<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AbsensiDetail extends Model
{
    use HasFactory;

    protected $table = 'absensi_detail';

   protected $fillable = [
    'absensi_id',
    'siswa_id',
    'status',
    'keterangan', // 🔥 TAMBAHKAN INI
    'waktu_absen'
];

    public function absensi()
    {
        return $this->belongsTo(Absensi::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}