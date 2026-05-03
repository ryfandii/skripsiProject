<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ujian;
use App\Models\Soal;
use Illuminate\Support\Facades\Auth;
class UjianController extends Controller
{
    public function index()
    {
        $data = Ujian::where('guru_id', auth()->id())->latest()->get();
        return view('guru.ujian.index', compact('data'));
    }

   public function create()
    {
        $user = Auth::user();

        // safety check
        if (!$user) {
            abort(403, 'Belum login');
        }

        $mapel = $user->mapel; // ✔ relasi sudah benar

        return view('guru.ujian.create', compact('mapel'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'soal' => 'required|array'
        ]);

        // 🔥 SIMPAN UJIAN
        $ujian = Ujian::create([
            'judul' => $request->judul,
            'durasi' => $request->durasi,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'guru_id' => auth()->user()->guru_id
        ]);

        // 🔥 SIMPAN SOAL
        foreach ($request->soal as $s) {
            Soal::create([
                'ujian_id' => $ujian->id,
                'pertanyaan' => $s['pertanyaan'],
                'a' => $s['a'],
                'b' => $s['b'],
                'c' => $s['c'],
                'd' => $s['d'],
                'jawaban_benar' => $s['jawaban'],
            ]);
        }

        return redirect()->route('guru.ujian.index')
            ->with('success', 'Ujian + soal berhasil dibuat');
    }

    public function soal($id)
    {
        $ujian = Ujian::findOrFail($id);
        return view('guru.ujian.soal', compact('ujian'));
    }

    public function storeSoal(Request $request, $id)
    {
        $request->validate([
            'soal' => 'required|array',
            'soal.*.pertanyaan' => 'required|string',
            'soal.*.a' => 'required|string',
            'soal.*.b' => 'required|string',
            'soal.*.c' => 'required|string',
            'soal.*.d' => 'required|string',
            'soal.*.jawaban' => 'required|in:a,b,c,d',
        ]);

        foreach ($request->soal as $s) {
            Soal::create([
                'ujian_id' => $id,
                'pertanyaan' => $s['pertanyaan'],
                'a' => $s['a'],
                'b' => $s['b'],
                'c' => $s['c'],
                'd' => $s['d'],
                'jawaban_benar' => $s['jawaban'],
            ]);
        }

        return back()->with('success','Soal disimpan');
    }
}
