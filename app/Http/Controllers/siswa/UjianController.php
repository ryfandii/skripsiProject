<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ujian;
use App\Models\Soal;
use App\Models\Hasil;

class UjianController extends Controller
{
   public function index()
{
    $siswa = auth()->user()->siswa;

    $ujians = Ujian::whereHas('kelas', fn($q) => $q->where('kelas.id', $siswa->kelas_id))
        ->where('status_kirim', 'terkirim')
        ->latest()
        ->get();

    $sudahDikerjakan = Hasil::where('siswa_id', $siswa->id)
        ->pluck('ujian_id')->toArray();

    $hasilSiswa = Hasil::where('siswa_id', $siswa->id)
        ->get()->keyBy('ujian_id');

    // ✅ FIX BARU: tandai ujian yang sudah lewat waktu
    $sudahBerakhir = $ujians
        ->filter(fn($u) => $u->selesai && \Carbon\Carbon::parse($u->selesai)->lt(now()))
        ->pluck('id')
        ->toArray();

    return view('siswa.ujian.index', compact('ujians', 'sudahDikerjakan', 'hasilSiswa', 'sudahBerakhir'));
}
   public function kerjakan($id)
{
    $siswa = auth()->user()->siswa;

    $sudah = Hasil::where('siswa_id', $siswa->id)
        ->where('ujian_id', $id)
        ->exists();

    if ($sudah) {
        return redirect()->route('siswa.ujian.index')
            ->with('warning', 'Kamu sudah mengerjakan ujian ini.');
    }

    $ujian = Ujian::findOrFail($id);

    // ✅ FIX: parse eksplisit dengan Carbon
    $mulai   = $ujian->mulai   ? \Carbon\Carbon::parse($ujian->mulai)   : null;
    $selesai = $ujian->selesai ? \Carbon\Carbon::parse($ujian->selesai) : null;

    if ($mulai && now()->lt($mulai)) {
        return redirect()->route('siswa.ujian.index')
            ->with('warning', 'Ujian belum dimulai. Silakan tunggu waktu ujian.');
    }

    if ($selesai && now()->gt($selesai)) {
        return redirect()->route('siswa.ujian.index')
            ->with('warning', 'Waktu ujian sudah berakhir, kamu tidak dapat mengerjakan ujian ini.');
    }

    $soals = Soal::where('ujian_id', $id)->get();

    return view('siswa.ujian.kerjakan', compact('ujian', 'soals'));
}

public function submit(Request $request, $id)
{
    $siswa = auth()->user()->siswa;

    $sudah = Hasil::where('siswa_id', $siswa->id)
        ->where('ujian_id', $id)
        ->exists();

    if ($sudah) {
        return redirect()->route('siswa.ujian.index')
            ->with('warning', 'Kamu sudah mengerjakan ujian ini.');
    }

    $ujian   = Ujian::findOrFail($id);
    $selesai = $ujian->selesai ? \Carbon\Carbon::parse($ujian->selesai) : null;

    // ✅ FIX: Cegah submit jika waktu sudah habis
    if ($selesai && now()->gt($selesai)) {
        return redirect()->route('siswa.ujian.index')
            ->with('warning', 'Waktu ujian sudah berakhir, jawaban tidak dapat dikumpulkan.');
    }

    $soals = Soal::where('ujian_id', $id)->get();
    $benar = 0;
    $total = $soals->count();

    foreach ($soals as $s) {
        $jawabanUser = $request->jawaban[$s->id] ?? null;
        if ($jawabanUser == $s->jawaban_benar) {
            $benar++;
        }
    }

    $nilai = round(($benar / $total) * 100);

    Hasil::create([
        'siswa_id' => $siswa->id,
        'ujian_id' => $id,
        'nilai'    => $nilai,
    ]);

    return view('siswa.ujian.hasil', compact('nilai', 'benar', 'total', 'ujian'));
}
}