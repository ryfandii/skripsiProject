<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index()
{
    $siswa_id = auth()->user()->siswa_id;

    // 🔹 Ambil nilai tugas
    $tugas = \App\Models\PengumpulanTugas::with('tugas.mapel')
        ->where('siswa_id', $siswa_id)
        ->get();

    // 🔹 Ambil nilai ujian
    $ujian = \App\Models\Hasil::with('ujian.mapel')
        ->where('siswa_id', $siswa_id)
        ->get();

    // 🔥 REKAP DATA
    $data = [];

    // =======================
    // 🔹 PROSES NILAI TUGAS
    // =======================
    foreach ($tugas as $t) {
        $mapel_id = $t->tugas->mapel->id ?? null;

        if (!$mapel_id) continue;

        if (!isset($data[$mapel_id])) {
            $data[$mapel_id] = [
                'mapel' => $t->tugas->mapel->nama_mapel,
                'tugas' => [],
                'uts' => null,
                'uas' => null,
            ];
        }

        $data[$mapel_id]['tugas'][] = $t->nilai;
    }

    // =======================
    // 🔹 PROSES NILAI UJIAN
    // =======================
    foreach ($ujian as $u) {
        $mapel_id = $u->ujian->mapel->id ?? null;

        if (!$mapel_id) continue;

        if (!isset($data[$mapel_id])) {
            $data[$mapel_id] = [
                'mapel' => $u->ujian->mapel->nama_mapel,
                'tugas' => [],
                'uts' => null,
                'uas' => null,
            ];
        }

        if ($u->ujian->jenis == 'UTS') {
            $data[$mapel_id]['uts'] = $u->nilai;
        }

        if ($u->ujian->jenis == 'UAS') {
            $data[$mapel_id]['uas'] = $u->nilai;
        }
    }

    // =======================
    // 🔹 HITUNG RATA-RATA
    // =======================
    foreach ($data as $k => $d) {

        $rata_tugas = count($d['tugas']) 
            ? array_sum($d['tugas']) / count($d['tugas']) 
            : 0;

        $uts = $d['uts'] ?? 0;
        $uas = $d['uas'] ?? 0;

        $rata = ($rata_tugas + $uts + $uas) / 3;

        $data[$k]['tugas'] = round($rata_tugas);
        $data[$k]['rata'] = round($rata);
    }

    return view('siswa.nilai.index', compact('data'));
}
}