<?php
namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('siswa.profile.index');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required',
            'foto' => 'nullable|image|mimes:jpg,png|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = time().'.'.$file->extension();
            $file->move(public_path('foto'), $namaFile);

            $user->foto = $namaFile;
        }

        $user->name = $request->name;
        $user->save();

        return back()->with('success', 'Profile berhasil diupdate');
    }
}