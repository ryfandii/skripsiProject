<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Guru;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    // ===================== INDEX =====================
    public function index(Request $request)
    {
        $kelas = Kelas::all(); // ✅ INI YANG KURANG

        $query = Jadwal::with(['kelas', 'mapel', 'guru']);

        // filter berdasarkan kelas
        if ($request->kelas_id) {
            $query->where('kelas_id', $request->kelas_id);
        }

        $jadwal = $query
    ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat')")
    ->orderBy('jam_mulai')
    ->get();
        return view('admin.jadwal.index', compact('jadwal', 'kelas'));
    }


    // ===================== CREATE =====================
    public function create()
    {
        $kelas = Kelas::all();
        $mapel = MataPelajaran::all();
        $guru = Guru::all();

        return view('admin.jadwal.create', compact('kelas', 'mapel', 'guru'));
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

         // ✅ Validasi jam selesai harus lebih besar dari jam mulai
    if ($request->jam_selesai <= $request->jam_mulai) {
        return back()->withInput()->with('error', 'Jam selesai harus lebih besar dari jam mulai!');
    }

        // 🔥 CEK BENTROK KELAS
        $cekKelas = Jadwal::where('kelas_id', $request->kelas_id)
            ->where('hari', $request->hari)
            ->where(function ($q) use ($request) {
                $q->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                  ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai]);
            })
            ->exists();

        if ($cekKelas) {
            return back()->withInput()->with('error', 'Kelas sudah memiliki jadwal di jam tersebut!');
        }

        // 🔥 CEK BENTROK GURU
        $cekGuru = Jadwal::where('guru_id', $request->guru_id)
            ->where('hari', $request->hari)
            ->where(function ($q) use ($request) {
                $q->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                  ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai]);
            })
            ->exists();

        if ($cekGuru) {
            return back()->withInput()->with('error', 'Guru sudah mengajar di jam tersebut!');
        }

        Jadwal::create([
            'kelas_id' => $request->kelas_id,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'guru_id' => $request->guru_id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Data berhasil ditambahkan');
    }


    // ===================== EDIT =====================
    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $kelas = Kelas::all();
        $mapel = MataPelajaran::all();
        $guru = Guru::all();

        return view('admin.jadwal.edit', compact('jadwal', 'kelas', 'mapel', 'guru'));
    }


    // ===================== UPDATE =====================
    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $request->validate([
            'kelas_id' => 'required',
            'mata_pelajaran_id' => 'required',
            'guru_id' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        // ✅ Validasi jam selesai harus lebih besar dari jam mulai
    if ($request->jam_selesai <= $request->jam_mulai) {
        return back()->withInput()->with('error', 'Jam selesai harus lebih besar dari jam mulai!');
    }

        $jadwal->update([
            'kelas_id' => $request->kelas_id,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'guru_id' => $request->guru_id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Data berhasil diupdate');
    }


    // ===================== GRID =====================
    public function grid()
    {
        $kelas = Kelas::all();

        $jadwal = Jadwal::with(['kelas', 'mapel', 'guru'])
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get();

        return view('admin.jadwal.grid', compact('jadwal', 'kelas'));
    }


    // ===================== DELETE =====================
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Data berhasil dihapus');
    }
}