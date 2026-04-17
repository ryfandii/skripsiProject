<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $nilai = Nilai::with(['mapel'])
            ->where('siswa_id', $user->siswa_id)
            ->get();

        return view('siswa.nilai.index', compact('nilai'));
    }
}