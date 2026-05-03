<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

   protected $fillable = [
    'guru_id',
    'kelas_id',
    'tanggal',
    'token',
    'dibuka',
    'mapel_id', 
    'waktu_selesai'// 🔥 WAJIB TAMBAHKAN
];

    // 🔥 RELASI

    public function detail()
    {
        return $this->hasMany(AbsensiDetail::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class, 'mapel_id');
    }
}