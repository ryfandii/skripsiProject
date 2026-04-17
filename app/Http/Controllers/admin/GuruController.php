<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{

    public function dashboard()
    {
        return view('guru.dashboard');
    }
    // ================= INDEX =================
    public function index()
    {
        $guru = Guru::with('user')->get();
        return view('admin.guru.index', compact('guru'));
    }

    // ================= CREATE =================
    public function create()
    {
        $mapel = MataPelajaran::all();
        return view('admin.guru.create', compact('mapel'));
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:gurus,nip',
            'mapel_id' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'email' => 'required|email|unique:users,email'
        ]);

        // 🔥 SIMPAN GURU
        $guru = Guru::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'mapel' => MataPelajaran::find($request->mapel_id)->nama_mapel,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'status' => 'aktif'
        ]);

        // 🔥 SIMPAN USER (FIX TELEPON MASUK)
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make('12345678'),
            'role' => 'guru',
            'guru_id' => $guru->id,
            'mapel_id' => $request->mapel_id,
            'telepon' => $request->telepon, // ✅ INI YANG PENTING
            'is_default_password' => true
        ]);

        return redirect()->route('admin.guru.index')
            ->with('success', 'Guru berhasil ditambahkan');
    }

    // ================= EDIT =================
    public function edit(Guru $guru)
    {
        $mapel = MataPelajaran::all();
        return view('admin.guru.edit', compact('guru', 'mapel'));
    }

    // ================= UPDATE =================
    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:gurus,nip,' . $guru->id,
            'mapel_id' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        // 🔥 UPDATE GURU
        $guru->update([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'mapel' => MataPelajaran::find($request->mapel_id)->nama_mapel,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);

        // 🔥 UPDATE USER (TELEPON JUGA UPDATE)
        $user = User::where('guru_id', $guru->id)->first();
        if ($user) {
            $user->update([
                'name' => $request->nama,
                'mapel_id' => $request->mapel_id,
                'telepon' => $request->telepon // ✅ WAJIB ADA
            ]);
        }

        return redirect()->route('admin.guru.index')
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    // ================= DELETE =================
    public function destroy(Guru $guru)
    {
        User::where('guru_id', $guru->id)->delete();
        $guru->delete();

        return back()->with('success', 'Data guru berhasil dihapus.');
    }

    // ================= NONAKTIF =================
    public function nonaktif($id)
    {
        Guru::where('id', $id)->update(['status' => 'nonaktif']);
        return back()->with('success', 'Guru dinonaktifkan');
    }

    // ================= AKTIFKAN =================
    public function aktifkan($id)
    {
        Guru::where('id', $id)->update(['status' => 'aktif']);
        return back()->with('success', 'Guru diaktifkan');
    }
}