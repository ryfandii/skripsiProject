<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    protected $fillable = ['siswa_id', 'ujian_id', 'nilai'];

    public function ujian()
    {
        return $this->belongsTo(\App\Models\Ujian::class, 'ujian_id');
    }

    public function siswa()
    {
        return $this->belongsTo(\App\Models\Siswa::class, 'siswa_id');
    }
}