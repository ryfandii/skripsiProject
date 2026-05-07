<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ujian;
use App\Models\Soal;
use App\Models\Hasil;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UjianController extends Controller
{
    // ── INDEX: daftar ujian + filter kelas untuk lihat nilai ──────────
    public function index(Request $request)
    {
        $data        = Ujian::where('guru_id', auth()->id())->latest()->get();
        $kelasList   = Kelas::all();
        $selectedKelas = $request->kelas_id;

        // Nilai siswa: tampilkan kalau ada filter kelas
        $nilaiSiswa = collect();
        if ($selectedKelas) {
            $nilaiSiswa = Hasil::with(['siswa', 'ujian'])
                ->whereHas('siswa', fn($q) => $q->where('kelas_id', $selectedKelas))
                ->whereHas('ujian',  fn($q) => $q->where('guru_id', auth()->id()))
                ->get();
        }

        return view('guru.ujian.index', compact('data', 'kelasList', 'selectedKelas', 'nilaiSiswa'));
    }

    // ── CREATE ────────────────────────────────────────────────────────
    public function create()
    {
        $user  = Auth::user();
        if (!$user) abort(403, 'Belum login');

        $kelas = Kelas::all();
        $guru = $user->guru; // relasi user -> guru
        $mapel = $guru ? \App\Models\MataPelajaran::where('id', $guru->mapel_id)->get() : collect();

        return view('guru.ujian.create', compact('kelas', 'mapel'));
    }

    // ── STORE ─────────────────────────────────────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'judul'    => 'required',
            'durasi'   => 'required|integer',
            'mulai'    => 'required|date',
            'selesai'  => 'required|date|after:mulai',
            'kelas_ids'=> 'required|array|min:1',
            'mapel_id' => 'required',
            'jenis'    => 'required|in:UTS,UAS',
            'soal'     => 'required|array|min:1',
            'soal.*.pertanyaan' => 'required',
            'soal.*.a' => 'required',
            'soal.*.b' => 'required',
            'soal.*.c' => 'required',
            'soal.*.d' => 'required',
            'soal.*.jawaban' => 'required|in:a,b,c,d',
        ]);

        DB::beginTransaction();
        try {
            $ujian = Ujian::create([
                'judul'        => $request->judul,
                'durasi'       => $request->durasi,
                'mulai'        => $request->mulai,
                'selesai'      => $request->selesai,
                'guru_id'      => auth()->id(),
                'mapel_id'     => $request->mapel_id,
                'jenis'        => $request->jenis,
                'status_kirim' => 'draft',
            ]);

            // Simpan pivot kelas (multi)
            $ujian->kelas()->sync($request->kelas_ids);

            // Simpan soal
            foreach ($request->soal as $s) {
                Soal::create([
                    'ujian_id'      => $ujian->id,
                    'pertanyaan'    => $s['pertanyaan'],
                    'a'             => $s['a'],
                    'b'             => $s['b'],
                    'c'             => $s['c'],
                    'd'             => $s['d'],
                    'jawaban_benar' => $s['jawaban'],
                ]);
            }

            DB::commit();
            return redirect()->route('guru.ujian.index')
                ->with('success', 'Ujian berhasil dibuat. Kirim ke siswa saat siap.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    // ── KIRIM ke semua kelas (ubah status_kirim → terkirim) ──────────
    public function kirim($id)
    {
        $ujian = Ujian::where('guru_id', auth()->id())->findOrFail($id);
        $ujian->update(['status_kirim' => 'terkirim']);

        return redirect()->route('guru.ujian.index')
            ->with('success', 'Ujian "' . $ujian->judul . '" berhasil dikirim ke siswa!');
    }

    // ── EDIT ─────────────────────────────────────────────────────────
    public function edit($id)
    {
        $ujian  = Ujian::where('guru_id', auth()->id())->with('kelas')->findOrFail($id);
        $kelas  = Kelas::all();
        $mapel  = \App\Models\MataPelajaran::all();
        $selectedKelas = $ujian->kelas->pluck('id')->toArray();

        return view('guru.ujian.edit', compact('ujian', 'kelas', 'mapel', 'selectedKelas'));
    }

    // ── UPDATE ────────────────────────────────────────────────────────
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'     => 'required',
            'durasi'    => 'required|integer',
            'mulai'     => 'required|date',
            'selesai'   => 'required|date|after:mulai',
            'kelas_ids' => 'required|array|min:1',
            'mapel_id'  => 'required',
            'jenis'     => 'required|in:UTS,UAS',
        ]);

        $ujian = Ujian::where('guru_id', auth()->id())->findOrFail($id);
        $ujian->update([
            'judul'    => $request->judul,
            'durasi'   => $request->durasi,
            'mulai'    => $request->mulai,
            'selesai'  => $request->selesai,
            'mapel_id' => $request->mapel_id,
            'jenis'    => $request->jenis,
        ]);
        $ujian->kelas()->sync($request->kelas_ids);

        return redirect()->route('guru.ujian.index')
            ->with('success', 'Ujian berhasil diupdate');
    }

    // ── DESTROY ───────────────────────────────────────────────────────
    public function destroy($id)
    {
        $ujian = Ujian::where('guru_id', auth()->id())->findOrFail($id);
        Soal::where('ujian_id', $ujian->id)->delete();
        $ujian->kelas()->detach();
        $ujian->delete();

        return redirect()->route('guru.ujian.index')
            ->with('success', 'Ujian berhasil dihapus');
    }

    // ── SOAL (opsional, halaman terpisah) ────────────────────────────
    public function soal($id)
    {
        $ujian = Ujian::findOrFail($id);
        return view('guru.ujian.soal', compact('ujian'));
    }
}