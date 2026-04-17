<?php

namespace App\Http\Controllers\Siswa;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $absensi = Absensi::where('siswa_id', $user->siswa_id)->get();

        return view('siswa.absensi.index', compact('absensi'));
    }
}