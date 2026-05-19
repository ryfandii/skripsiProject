<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class NilaiController extends Controller
{
    public function index()
    {
        $siswa_id = Auth::user()->siswa_id;

        // Cek apakah kolom sudah_kirim sudah ada di tabel nilai
        $hasSudahKirim = Schema::hasColumn('nilai', 'sudah_kirim');

        $query = Nilai::with('mapel')
            ->where('siswa_id', $siswa_id);

        // Hanya filter sudah_kirim kalau kolomnya sudah ada
        if ($hasSudahKirim) {
            $query->where('sudah_kirim', 1);
        }

        $nilaiGuru = $query->get();

        // Rekap dari nilai guru
        $data = [];
        foreach ($nilaiGuru as $n) {
            $mapel_id = $n->mapel_id;
            if (!$mapel_id) continue;

            // Kalau kolom sudah_kirim belum ada, tampilkan yang nilai_akhir-nya sudah terisi saja
            if (!$hasSudahKirim && $n->nilai_akhir === null) continue;

            $data[$mapel_id] = [
                'mapel' => $n->mapel->nama_mapel ?? '—',
                'tugas' => $n->nilai_tugas !== null ? round($n->nilai_tugas) : null,
                'uts'   => $n->nilai_uts   !== null ? round($n->nilai_uts)   : null,
                'uas'   => $n->nilai_uas   !== null ? round($n->nilai_uas)   : null,
                'rata'  => $n->nilai_akhir !== null ? round($n->nilai_akhir) : null,
            ];
        }

        // Fallback ke sistem lama kalau belum ada data dari guru
        if (empty($data)) {
            $data = $this->getRekapsLama($siswa_id);
        }

        return view('siswa.nilai.index', compact('data'));
    }

    /**
     * Fallback rekap dari PengumpulanTugas & Hasil (sistem lama)
     */
    private function getRekapsLama($siswa_id): array
    {
        $tugas = \App\Models\PengumpulanTugas::with('tugas.mapel')
            ->where('siswa_id', $siswa_id)->get();

        $ujian = \App\Models\Hasil::with('ujian.mapel')
            ->where('siswa_id', $siswa_id)->get();

        $data = [];

        foreach ($tugas as $t) {
            $mapel_id = $t->tugas->mapel->id ?? null;
            if (!$mapel_id) continue;
            if (!isset($data[$mapel_id])) {
                $data[$mapel_id] = [
                    'mapel'     => $t->tugas->mapel->nama_mapel,
                    'tugas_arr' => [],
                    'uts'       => null,
                    'uas'       => null,
                ];
            }
            if ($t->nilai !== null) {
                $data[$mapel_id]['tugas_arr'][] = $t->nilai;
            }
        }

        foreach ($ujian as $u) {
            $mapel_id = $u->ujian->mapel->id ?? null;
            if (!$mapel_id) continue;
            if (!isset($data[$mapel_id])) {
                $data[$mapel_id] = [
                    'mapel'     => $u->ujian->mapel->nama_mapel,
                    'tugas_arr' => [],
                    'uts'       => null,
                    'uas'       => null,
                ];
            }
            if (strtoupper($u->ujian->jenis) === 'UTS') $data[$mapel_id]['uts'] = $u->nilai;
            if (strtoupper($u->ujian->jenis) === 'UAS') $data[$mapel_id]['uas'] = $u->nilai;
        }

        foreach ($data as $k => $d) {
            $rata_tugas = count($d['tugas_arr'])
                ? array_sum($d['tugas_arr']) / count($d['tugas_arr'])
                : null;
            $uts  = $d['uts'] ?? null;
            $uas  = $d['uas'] ?? null;
            $parts = array_filter([$rata_tugas, $uts, $uas], fn($v) => $v !== null);
            $rata  = count($parts) ? round(array_sum($parts) / count($parts)) : null;

            $data[$k] = [
                'mapel' => $d['mapel'],
                'tugas' => $rata_tugas !== null ? round($rata_tugas) : null,
                'uts'   => $uts !== null ? round($uts) : null,
                'uas'   => $uas !== null ? round($uas) : null,
                'rata'  => $rata,
            ];
        }

        return $data;
    }
}