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
        // Statistik utama
        $jumlahSiswa = Siswa::count();
        $jumlahGuru = Guru::count();
        $jumlahKelas = Kelas::count();
        $jumlahMapel = MataPelajaran::count();

        // Siswa terbaru
        $siswaTerbaru = Siswa::with('kelas')
            ->latest()
            ->take(5)
            ->get();

        // 🔥 Nilai tertinggi
        $nilaiTertinggi = Nilai::with('siswa')
            ->orderBy('nilai', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'jumlahSiswa',
            'jumlahGuru',
            'jumlahKelas',
            'jumlahMapel',
            'siswaTerbaru',
            'nilaiTertinggi'
        ));
    }
}