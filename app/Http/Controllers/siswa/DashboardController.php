<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Nilai;
use App\Models\AbsensiDetail;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

        public function index()
    {
        $user = auth()->user();

        $nilai = \App\Models\Nilai::where('siswa_id', $user->siswa_id)->get();

        $rataNilai = $nilai->avg('nilai');

        $nilaiTerbaru = \App\Models\Nilai::with('mapel')
            ->where('siswa_id', $user->siswa_id)
            ->latest()
            ->limit(5)
            ->get();

        $absensiTerakhir = \App\Models\AbsensiDetail::where('siswa_id', $user->siswa_id)
            ->latest()
            ->limit(5)
            ->get();

        $hadir = \App\Models\AbsensiDetail::where('siswa_id', $user->siswa_id)
            ->where('status', 'hadir')
            ->count();

        $tugas = 0;

        return view('siswa.dashboard', compact(
            'rataNilai',
            'nilaiTerbaru',
            'absensiTerakhir',
            'hadir',
            'tugas'
        ));
    }
}