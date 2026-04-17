<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    // ================= INDEX =================
    public function index(Request $request)
    {
        $kelas = Kelas::all();

        $query = Siswa::with(['kelas', 'user']);

        if ($request->kelas_id) {
            $query->where('kelas_id', $request->kelas_id);
        }

        $siswa = $query->get();

        return view('admin.siswa.index', compact('siswa', 'kelas'));
    }

    // ================= CREATE =================
    public function create()
    {
        $kelas = Kelas::all();
        return view('admin.siswa.create', compact('kelas'));
    }

    // ================= STORE =================
    public function store(Request $request)
    {
       $request->validate([
    'nama' => 'required',
    'jenis_kelamin' => 'required',
    'nama_ortu' => 'required',
    'nis' => 'required|unique:siswa,nis',
    'kelas_id' => 'required',
    'alamat' => 'required',
    'telepon' => 'required',
    'email' => 'required|email|unique:users,email',
]);

$siswa = Siswa::create([
    'nama' => $request->nama,
    'jenis_kelamin' => $request->jenis_kelamin,
    'nama_ortu' => $request->nama_ortu,
    'nis' => $request->nis,
    'kelas_id' => $request->kelas_id,
    'alamat' => $request->alamat,
    'telepon' => $request->telepon,
    'status' => 'aktif'
]);

        // simpan user login
        User::create([
    'name' => $request->nama,
    'email' => $request->email,
    'password' => Hash::make('12345678'), // 🔥 default
    'role' => 'siswa', // atau guru
    'siswa_id' => $siswa->id,
    'is_default_password' => true // 🔥 WAJIB
]);

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Siswa + akun login berhasil dibuat');
    }

    // ================= EDIT =================
    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();
        return view('admin.siswa.edit', compact('siswa', 'kelas'));
    }

    // ================= UPDATE =================
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
    'nama' => 'required',
    'jenis_kelamin' => 'required',
    'nama_ortu' => 'required',
    'nis' => 'required|unique:siswa,nis,' . $siswa->id,
    'kelas_id' => 'required',
    'alamat' => 'required',
    'telepon' => 'required',
]);

$siswa->update([
    'nama' => $request->nama,
    'jenis_kelamin' => $request->jenis_kelamin,
    'nama_ortu' => $request->nama_ortu,
    'nis' => $request->nis,
    'kelas_id' => $request->kelas_id,
    'alamat' => $request->alamat,
    'telepon' => $request->telepon,
]);

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    // ================= DELETE =================
    public function destroy(Siswa $siswa)
    {
        // hapus user terkait
        User::where('siswa_id', $siswa->id)->delete();

        $siswa->delete();

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }

    // ================= NONAKTIF =================
    public function nonaktif($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->status = 'nonaktif';
        $siswa->save();

        return back()->with('success', 'Siswa dinonaktifkan');
    }

    // ================= AKTIFKAN =================
    public function aktifkan($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->status = 'aktif';
        $siswa->save();

        return back()->with('success', 'Siswa diaktifkan');
    }

    // ================= BULK NONAKTIF =================
    public function bulkNonaktif(Request $request)
{
    if (!$request->ids) {
        return back()->with('error', 'Pilih minimal 1 siswa!');
    }

    Siswa::whereIn('id', $request->ids)
        ->update(['status' => 'nonaktif']);

    return back()->with('success', 'Siswa berhasil dinonaktifkan');
}

    
}