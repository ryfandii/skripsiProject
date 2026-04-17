<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa'; // 🔥 penting karena tabel kamu "siswa" bukan "siswas"

   protected $fillable = [
    'nama',
    'jenis_kelamin',
    'nama_ortu',
    'nis',
    'kelas_id',
    'alamat',
    'telepon',
    'status'
];

    public $timestamps = true;
public function user()
{
    return $this->hasOne(\App\Models\User::class, 'siswa_id');
}
    public function kelas()
{
    return $this->belongsTo(\App\Models\Kelas::class);
}
}