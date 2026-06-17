<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }

   public function update(Request $request)
{
    $user = Auth::user();

    $rules = [
        'name'  => 'required',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ];

    // Tambahan validasi khusus siswa
    if ($user->role == 'siswa') {
        $rules['nama_ortu'] = 'required';
        $rules['alamat']    = 'required';
        $rules['telepon']   = 'required';
    }

    $request->validate($rules);

    // Update foto
    if ($request->hasFile('photo')) {
        $file     = $request->file('photo');
        $namaFile = time() . '.' . $file->extension();
        $file->move(public_path('uploads'), $namaFile);
        $user->photo = $namaFile;
    }

    $user->name = $request->name;
    $user->save();

    // Update tabel siswa jika role siswa
    if ($user->role == 'siswa' && $user->siswa) {
        $telepon = ltrim($request->telepon, '+');
        if (strpos($telepon, '62') === 0) {
            $telepon = '0' . substr($telepon, 2);
        }

        $user->siswa->update([
            'nama'      => $request->name,
            'nama_ortu' => $request->nama_ortu,
            'alamat'    => $request->alamat,
            'telepon'   => $telepon,
        ]);
    }

    return back()->with('success', 'Profile berhasil diupdate');
}
}