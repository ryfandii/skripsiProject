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
    $siswa  = auth()->user()->siswa;

    // Hanya tampilkan ujian yang dikirim ke kelas siswa ini & status terkirim
    $ujians = Ujian::whereHas('kelas', fn($q) => $q->where('kelas.id', $siswa->kelas_id))
        ->where('status_kirim', 'terkirim')
        ->latest()
        ->get();

    $sudahDikerjakan = Hasil::where('siswa_id', $siswa->id)
        ->pluck('ujian_id')->toArray();

    $hasilSiswa = Hasil::where('siswa_id', $siswa->id)
        ->get()->keyBy('ujian_id');

    return view('siswa.ujian.index', compact('ujians', 'sudahDikerjakan', 'hasilSiswa'));
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
        $soals = Soal::where('ujian_id', $id)->get();

        return view('siswa.ujian.kerjakan', compact('ujian', 'soals'));
    }

    public function submit(Request $request, $id)
    {
        $siswa = auth()->user()->siswa;

        // Cegah submit ulang
        $sudah = Hasil::where('siswa_id', $siswa->id)
            ->where('ujian_id', $id)
            ->exists();

        if ($sudah) {
            return redirect()->route('siswa.ujian.index')
                ->with('warning', 'Kamu sudah mengerjakan ujian ini.');
        }

        $soals = Soal::where('ujian_id', $id)->get();
        $ujian = Ujian::findOrFail($id);

        $benar = 0;
        $total = $soals->count();

        foreach ($soals as $s) {
            $jawabanUser = $request->jawaban[$s->id] ?? null;
            if ($jawabanUser == $s->jawaban_benar) {
                $benar++;
            }
        }

        $nilai = round(($benar / $total) * 100);

        // Simpan ke tabel hasils (hanya kolom yang ada)
        Hasil::create([
            'siswa_id' => $siswa->id,
            'ujian_id' => $id,
            'nilai'    => $nilai,
        ]);

        return view('siswa.ujian.hasil', compact('nilai', 'benar', 'total', 'ujian'));
    }
}