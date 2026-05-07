<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Nilai;

class DashboardController extends Controller
{
    public function index()
    {
        // =====================
        // 🔥 STATISTIK
        // =====================
        $jumlahSiswa = Siswa::count();
        $jumlahGuru = Guru::count();
        $jumlahKelas = Kelas::count();
        $jumlahMapel = MataPelajaran::count();

        // =====================
        // 🔥 SISWA TERBARU
        // =====================
        $siswaTerbaru = Siswa::with('kelas')
            ->latest()
            ->take(5)
            ->get();

        // =====================
        // 🔥 NILAI TERTINGGI
        $nilaiTertinggi = Nilai::with('siswa')
            ->selectRaw('*, (nilai_tugas + nilai_uts + nilai_uas)/3 as nilai_akhir')
            ->orderBy('nilai_akhir', 'desc')
            ->take(5)
            ->get();

        // =====================
        // 🔥 CHART: SISWA PER KELAS
        // =====================
        $kelas = Kelas::withCount('siswa')->get();

        $kelasLabels = $kelas->pluck('nama');
        $kelasData = $kelas->pluck('siswa_count');

        // =====================
        // 🔥 CHART: DISTRIBUSI NILAI
        // =====================
        $nilaiDistribusi = Nilai::selectRaw('
    CASE 
        WHEN (nilai_tugas + nilai_uts + nilai_uas)/3 >= 90 THEN "A"
        WHEN (nilai_tugas + nilai_uts + nilai_uas)/3 >= 80 THEN "B"
        WHEN (nilai_tugas + nilai_uts + nilai_uas)/3 >= 70 THEN "C"
        ELSE "D"
    END as grade,
    COUNT(*) as total
')
            ->groupBy('grade')
            ->pluck('total', 'grade');

        // =====================
        // RETURN VIEW
        // =====================
        return view('admin.dashboard', compact(
            'jumlahSiswa',
            'jumlahGuru',
            'jumlahKelas',
            'jumlahMapel',
            'siswaTerbaru',
            'nilaiTertinggi',
            'kelasLabels',
            'kelasData',
            'nilaiDistribusi'
        ));
    }
}