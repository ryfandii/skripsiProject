<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tugas;
use App\Models\PengumpulanTugas;
use Carbon\Carbon;

class TugasController extends Controller
{
   public function index()
{
    $siswa = auth()->user()->siswa;

    $tugas = Tugas::with('mapel')
        ->where('kelas_id', $siswa->kelas_id)
        ->get();

    foreach ($tugas as $t) {

        $pengumpulan = \App\Models\PengumpulanTugas::where('tugas_id', $t->id)
            ->where('siswa_id', $siswa->id)
            ->first();

        $deadline = \Carbon\Carbon::parse($t->deadline);

        $t->waktu_kumpul = null;
        $t->nilai = null;
        $t->komentar = null;
        $t->status = 'belum';

        if ($pengumpulan) {
            $t->waktu_kumpul = $pengumpulan->created_at;
            $t->nilai = $pengumpulan->nilai;
            $t->komentar = $pengumpulan->komentar;

            if ($pengumpulan->created_at > $deadline) {
                $t->status = 'telat';
            } else {
                $t->status = 'tepat';
            }
        } else {
            if (now()->gt($deadline)) {
                $t->status = 'lewat';
            }
        }
    }

    return view('siswa.tugas.index', compact('tugas'));
}

    public function kumpul($id)
{
    $tugas = Tugas::findOrFail($id);

    if (now()->gt($tugas->deadline)) {
        return redirect()->route('siswa.tugas.index')
            ->with('error', 'Deadline sudah lewat, tidak bisa mengumpulkan tugas');
    }

    return view('siswa.tugas.kumpul', compact('tugas'));
}

    public function store(Request $request, $id)
{
    $tugas = Tugas::findOrFail($id);

    // 🔥 BLOCK UTAMA
    if (now()->gt($tugas->deadline)) {
        return redirect()->route('siswa.tugas.index')
            ->with('error', 'Tugas sudah melewati deadline');
    }

    $request->validate([
        'file' => 'required|mimes:pdf,doc,docx|max:2048'
    ]);

    $filePath = $request->file('file')->store('jawaban_tugas', 'public');

    PengumpulanTugas::create([
        'tugas_id' => $id,
        'siswa_id' => auth()->user()->siswa->id,
        'file' => $filePath
    ]);

    return redirect()->route('siswa.tugas.index')
        ->with('success', 'Tugas berhasil dikumpulkan');
}
}