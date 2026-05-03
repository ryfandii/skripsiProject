<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\AbsensiDetail;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    // 🔹 LIST ABSENSI AKTIF
   public function index()
{
    $siswa = auth()->user()->siswa;

    $absensis = Absensi::with(['mapel', 'guru'])
        ->where('kelas_id', $siswa->kelas_id)
        ->where('dibuka', true)
        ->where(function ($q) {
            $q->whereNull('waktu_selesai')
              ->orWhere('waktu_selesai', '>', now());
        })
        ->latest()
        ->get();

    // 🔥 GROUP BY MAPEL (INI YANG KURANG)
    $groupedAbsensi = $absensis->groupBy(function ($item) {
        return $item->mapel->nama_mapel ?? 'Tanpa Mapel';
    });

    // 🔥 CEK SUDAH ABSEN
    $sudahAbsen = AbsensiDetail::where('siswa_id', $siswa->id)
        ->pluck('absensi_id')
        ->toArray();

    return view('siswa.absensi.index', compact('groupedAbsensi', 'sudahAbsen'));
}

    // 🔹 SCAN QR
    public function scan($token)
    {
        $absensi = Absensi::where('token', $token)->firstOrFail();

        return view('siswa.absensi.scan', compact('absensi'));
    }

    // 🔹 SUBMIT HADIR
   public function hadir(Request $request)
{
    $request->validate([
        'absensi_id' => 'required|exists:absensi,id'
    ]);

    $absensi = Absensi::findOrFail($request->absensi_id);

    // 🔥 VALIDASI WAKTU
    if ($absensi->waktu_selesai && now()->greaterThan($absensi->waktu_selesai)) {
        return back()->with('error', 'Waktu absensi sudah habis!');
    }

    $siswa = auth()->user()->siswa;

    $cek = AbsensiDetail::where('absensi_id', $absensi->id)
        ->where('siswa_id', $siswa->id)
        ->exists();

    if ($cek) {
        return back()->with('error', 'Kamu sudah absen!');
    }

    AbsensiDetail::create([
        'absensi_id' => $absensi->id,
        'siswa_id' => $siswa->id,
        'status' => 'hadir',
        'waktu_absen' => now()
    ]);

    return back()->with('success', 'Absensi berhasil!');
}
}