<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    // ===================== INDEX =====================
    public function index()
    {
        $kelas = Kelas::latest()->get(); // 🔥 urut terbaru

        return view('admin.kelas.index', compact('kelas')); // 🔥 FIX
    }

    // ===================== CREATE =====================
    public function create()
    {
        return view('admin.kelas.create'); // 🔥 FIX
    }

    // ===================== STORE =====================
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:50|unique:kelas,nama_kelas',
            'jurusan' => 'required|string|max:100',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    // ===================== EDIT =====================
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);

        return view('admin.kelas.edit', compact('kelas')); // 🔥 FIX
    }

    // ===================== UPDATE =====================
    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'nama_kelas' => 'required|string|max:50|unique:kelas,nama_kelas,' . $id,
            'jurusan' => 'required|string|max:100',
        ]);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Data berhasil diupdate');
    }

    // ===================== DELETE =====================
   public function destroy($id)
{
    $kelas = Kelas::findOrFail($id);

    // 🔥 CEK RELASI JADWAL
    if (method_exists($kelas, 'jadwal') && $kelas->jadwal()->count() > 0) {
        return back()->with('error', 'Kelas tidak bisa dihapus karena sudah dipakai di jadwal!');
    }

    $kelas->delete();

    return redirect()->route('admin.kelas.index')
        ->with('success', 'Data berhasil dihapus');
}
}