<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    // ===================== INDEX =====================
    public function index()
{
    $user = Auth::user();

    // 🔥 ambil guru_id dari user login
    $guru_id = $user->guru_id;

    // 🔥 filter hanya jadwal milik guru tersebut
    $jadwal = \App\Models\Jadwal::with(['kelas', 'mapel', 'guru'])
                ->where('guru_id', $guru_id)
                ->get();

    return view('guru.jadwal', compact('jadwal'));
}

    // ===================== CREATE =====================
    public function create()
    {
        $kelas = Kelas::all();
        $mapel = MataPelajaran::all();
        $guru = Guru::all(); // 🔥 WAJIB

        return view('jadwal.create', compact('kelas', 'mapel', 'guru'));
    }

    // ===================== STORE =====================
    public function store(Request $request)
{
    $request->validate([
        'kelas_id' => 'required',
        'mata_pelajaran_id' => 'required',
        'guru_id' => 'required',
        'hari' => 'required',
        'jam_mulai' => 'required',
        'jam_selesai' => 'required',
    ]);

    // 🔥 VALIDASI BENTROK KELAS
    $cekKelas = Jadwal::where('kelas_id', $request->kelas_id)
        ->where('hari', $request->hari)
        ->where(function($q) use ($request) {
            $q->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
              ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai]);
        })
        ->exists();

    if ($cekKelas) {
        return back()->with('error', 'Kelas sudah memiliki jadwal di jam tersebut!');
    }

    // 🔥 VALIDASI BENTROK GURU
    $cekGuru = Jadwal::where('guru_id', $request->guru_id)
        ->where('hari', $request->hari)
        ->where(function($q) use ($request) {
            $q->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
              ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai]);
        })
        ->exists();

    if ($cekGuru) {
        return back()->with('error', 'Guru sudah mengajar di jam tersebut!');
    }

    // ✅ SIMPAN
    Jadwal::create($request->all());

    return redirect()->route('jadwal.index')
        ->with('success', 'Data berhasil ditambahkan');
}
    // ===================== EDIT =====================
    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $kelas = Kelas::all();
        $mapel = MataPelajaran::all();
        $guru = Guru::all(); // 🔥 TAMBAH

        return view('jadwal.edit', compact('jadwal', 'kelas', 'mapel', 'guru'));
    }

    // ===================== UPDATE =====================
    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $request->validate([
            'kelas_id' => 'required',
            'mata_pelajaran_id' => 'required',
            'guru_id' => 'required', // 🔥 TAMBAH
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')
            ->with('success', 'Data berhasil diupdate');
    }

public function grid()
{
    $kelas = Kelas::all();

    $jadwal = Jadwal::with(['kelas', 'mapel', 'guru'])
        ->orderBy('jam_mulai')
        ->get();

    return view('jadwal.grid', compact('jadwal', 'kelas'));
}

    // ===================== DELETE =====================
    public function destroy($id)
    {
        Jadwal::destroy($id);

        return redirect()->route('jadwal.index')
            ->with('success', 'Data berhasil dihapus');
    }
}