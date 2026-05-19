<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanAkademikController extends Controller
{
    public function index()
    {
        $nilai = Nilai::with(['siswa', 'mapel'])
            ->orderBy('id_siswa')
            ->get()
            ->groupBy('id_siswa');

        return view('admin.laporan-akademik.index', compact('nilai'));
    }

    public function cetak($idSiswa)
    {
        $nilai = Nilai::with(['siswa', 'mapel'])
            ->where('id_siswa', $idSiswa)
            ->get();

        if ($nilai->isEmpty()) {
            abort(404, 'Data nilai tidak ditemukan.');
        }

        $siswa = $nilai->first()->siswa;
        $rataRata = round($nilai->avg('nilai_akhir'), 2);

        $pdf = Pdf::loadView('admin.laporan-akademik.pdf', compact(
            'nilai',
            'siswa',
            'rataRata'
        ))->setPaper('A4', 'portrait');

        return $pdf->stream('laporan-akademik-' . $siswa->nama . '.pdf');
    }
}