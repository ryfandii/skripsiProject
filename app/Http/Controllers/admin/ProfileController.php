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

        $request->validate([
            'name' => 'required',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // update nama
        $user->name = $request->name;

        // upload foto
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);

            $user->photo = $filename;
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diupdate');
    }
}