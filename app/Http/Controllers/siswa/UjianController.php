<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ujian;
use App\Models\Soal;
use App\Models\Jawaban;
use App\Models\Hasil;

class UjianController extends Controller
{
       public function index()
    {
        $ujians = Ujian::all();
        return view('siswa.ujian.index', compact('ujians'));
    }

    public function kerjakan($id)
    {
        $ujian = Ujian::findOrFail($id);
        $soals = Soal::where('ujian_id', $id)->get();

        return view('siswa.ujian.kerjakan', compact('ujian','soals'));
    }
  public function submit(Request $request, $id)
{
    $soals = Soal::where('ujian_id', $id)->get();

    $benar = 0;
    $total = $soals->count();

    foreach ($soals as $s) {
        $jawabanUser = $request->jawaban[$s->id] ?? null;

        if ($jawabanUser == $s->jawaban_benar) {
            $benar++;
        }
    }

    $nilai = ($benar / $total) * 100;

    return view('siswa.ujian.hasil', [
        'nilai' => $nilai,
        'benar' => $benar,
        'total' => $total
    ]);
}

    
}
