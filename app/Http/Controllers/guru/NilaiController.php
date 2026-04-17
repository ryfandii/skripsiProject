<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use App\Models\Kelas;

class NilaiController extends Controller
{
    // 📌 Tampilkan semua nilai
    public function index(Request $request)
{
    $user = auth()->user();

    // ambil mapel guru
    $mapel_id = $user->mapel_id;

    // ambil semua kelas (buat dropdown filter)
    $kelas = \App\Models\Kelas::all();

    // query nilai + relasi siswa & mapel
    $query = \App\Models\Nilai::with(['siswa.kelas', 'mapel'])
        ->where('mapel_id', $mapel_id);

    // 🔥 FILTER KELAS
    if ($request->kelas_id) {
        $query->whereHas('siswa', function ($q) use ($request) {
            $q->where('kelas_id', $request->kelas_id);
        });
    }

    $nilai = $query->get();

    return view('guru.nilai.index', compact('nilai', 'kelas'));
}
    // 📌 Halaman input nilai per kelas
   public function inputNilai()
{
    $kelas = Kelas::all();

    // 🔥 ambil mapel sesuai guru login
    $mapel = MataPelajaran::find(auth()->user()->mapel_id);

    if (!$mapel) {
        return back()->with('error', 'Mapel belum disetting!');
    }

    return view('guru.nilai.input', compact('kelas', 'mapel'));
}

    // 📌 Ambil siswa berdasarkan kelas (AJAX)
   public function getSiswaByKelas($id)
{
    $siswa = Siswa::where('kelas_id', $id)->get();

    return response()->json($siswa);
}

    // 📌 Simpan nilai banyak sekaligus
    public function storeBatch(Request $request)
    {
        $request->validate([
            'mapel_id' => 'required',
            'nilai' => 'required|array'
        ]);

        foreach ($request->nilai as $siswa_id => $nilai) {

            if ($nilai != null) {
                Nilai::updateOrCreate(
                    [
                        'siswa_id' => $siswa_id,
                        'mapel_id' => $request->mapel_id
                    ],
                    [
                        'nilai' => $nilai
                    ]
                );
            }
        }

        return redirect()->route('guru.nilai.index')
                         ->with('success', 'Nilai berhasil disimpan');
    }

    // ================= CRUD BIASA =================

    public function create()
    {
        $siswa = Siswa::all();
        $mapel = MataPelajaran::all();

        return view('guru.nilai.create', compact('siswa', 'mapel'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required',
            'mapel_id' => 'required',
            'nilai' => 'required|numeric|min:0|max:100',
        ]);

        Nilai::create($request->all());

        return redirect()->route('guru.nilai.index')
                         ->with('success', 'Data nilai berhasil ditambahkan');
    }

    public function edit($id)
{
    $nilai = Nilai::with(['siswa', 'mapel'])->findOrFail($id);

    return view('guru.nilai.edit', compact('nilai'));
}

    public function update(Request $request, $id)
{
    $request->validate([
        'nilai' => 'required|numeric|min:0|max:100'
    ]);

    $nilai = Nilai::findOrFail($id);

    $nilai->update([
        'nilai' => $request->nilai
    ]);

    return redirect()->route('guru.nilai.index')
        ->with('success', 'Nilai berhasil diupdate');
}

    public function destroy($id)
    {
        Nilai::findOrFail($id)->delete();

        return redirect()->route('guru.nilai.index')
                         ->with('success', 'Data nilai berhasil dihapus');
    }
}