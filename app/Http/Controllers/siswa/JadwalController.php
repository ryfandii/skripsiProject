<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;

class JadwalController extends Controller
{
   public function index()
{
    $user = auth()->user();

    if (!$user->siswa) {
        return "Siswa tidak ditemukan";
    }

    $jadwal = \App\Models\Jadwal::with(['kelas', 'mapel', 'guru'])
        ->where('kelas_id', $user->siswa->kelas_id)
        ->get();

    return view('siswa.jadwal.index', compact('jadwal'));
}
}