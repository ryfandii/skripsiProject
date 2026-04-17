<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $mapel = MataPelajaran::all();
        return view('admin.mapel.index', compact('mapel'));
    }

    public function create()
    {
        return view('admin.mapel.create');
    }

    public function store(Request $request)
    {
        // 🔥 DEBUG (hapus kalau sudah jalan)
        // dd($request->all());

        $request->validate([
            'nama_mapel' => 'required',
            'kode_mapel' => 'required|unique:mata_pelajarans,kode_mapel',
            'jam_pelajaran' => 'required'
        ]);

        MataPelajaran::create($request->all());

        return redirect()->route('admin.mapel.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $mapel = MataPelajaran::findOrFail($id);
        return view('admin.mapel.edit', compact('mapel'));
    }

    public function update(Request $request, $id)
    {
        $mapel = MataPelajaran::findOrFail($id);

        $request->validate([
            'nama_mapel' => 'required',
            'kode_mapel' => 'required|unique:mata_pelajarans,kode_mapel,' . $id,
            'jam_pelajaran' => 'required'
        ]);

        $mapel->update($request->all());

        return redirect()->route('admin.mapel.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        MataPelajaran::destroy($id);

        return redirect()->route('admin.mapel.index')
            ->with('success', 'Data berhasil dihapus');
    }
}