<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa; // WAJIB ditambahkan

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'jurusan'
    ];

    // Relasi ke siswa
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }
}