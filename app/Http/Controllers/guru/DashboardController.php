<?php

namespace App\Http\Controllers\guru;

use App\Models\Jadwal;
use App\Models\Absensi;
use App\Models\Tugas;
use App\Models\Ujian;


use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

public function index()
{
    $guruId = auth()->user()->guru_id;

    $jumlahJadwal = Jadwal::where('guru_id', $guruId)->count();

    $jumlahAbsensi = Absensi::where('guru_id', $guruId)->count();

    $jumlahTugas = Tugas::where('guru_id', $guruId)->count();

    $jumlahUjian = Ujian::where('guru_id', $guruId)->count();

    return view('guru.dashboard', compact(
        'jumlahJadwal',
        'jumlahAbsensi',
        'jumlahTugas',
        'jumlahUjian'
    ));
}
}
