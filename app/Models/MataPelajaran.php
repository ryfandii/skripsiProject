<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajarans';

    protected $fillable = [
        'nama_mapel',
        'kode_mapel',
        'jam_pelajaran'
    ];

      public function jadwal()
{
    return $this->hasMany(Jadwal::class, 'mata_pelajaran_id');
}
}