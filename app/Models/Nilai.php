<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';

    protected $fillable = ['siswa_id', 'mapel_id', 'nilai'];

    public function siswa()
{
    return $this->belongsTo(\App\Models\Siswa::class);
}

    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class);
    }
}