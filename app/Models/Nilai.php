<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';

    protected $fillable = [
        'siswa_id',
        'mapel_id',
        'nilai',          // lama, jangan dihapus
        'nilai_tugas',
        'nilai_uts',
        'nilai_uas',
        'nilai_akhir',    // hasil hitung rata-rata (disimpan permanen)
        'sudah_kirim',    // 0 = belum kirim ke siswa, 1 = sudah kirim
    ];

    public function siswa()
    {
        return $this->belongsTo(\App\Models\Siswa::class);
    }

    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class, 'mapel_id');
    }

    /**
     * Accessor: hitung nilai akhir dinamis (kalau kolom nilai_akhir belum diisi)
     */
    public function getNilaiAkhirDinamisAttribute()
    {
        if ($this->nilai_akhir !== null) {
            return $this->nilai_akhir;
        }

        $parts = array_filter([
            $this->nilai_tugas !== null ? (float) $this->nilai_tugas : null,
            $this->nilai_uts   !== null ? (float) $this->nilai_uts   : null,
            $this->nilai_uas   !== null ? (float) $this->nilai_uas   : null,
        ], fn($v) => $v !== null);

        if (count($parts) > 0) {
            return round(array_sum($parts) / count($parts), 2);
        }

        // Fallback ke nilai lama
        return $this->nilai;
    }
}