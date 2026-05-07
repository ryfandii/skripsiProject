<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\AbsensiDetail;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Siswa;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $kelas = Kelas::all();
        $mapel = MataPelajaran::find(auth()->user()->guru->mapel_id);

        if (!$mapel) {
            return back()->with('error', 'Mapel guru belum diatur!');
        }

        $siswa = null;
        $kelasAktif = null;
        $riwayat = null;

        $aksi = $request->aksi;
        $tanggal = $request->tanggal ?? now()->toDateString();

        if ($request->kelas_id && $request->mapel_id) {

            // 🔍 MODE LIHAT RIWAYAT
            if ($aksi == 'lihat') {

                $absensi = Absensi::where('kelas_id', $request->kelas_id)
                    ->where('mapel_id', $request->mapel_id)
                    ->whereDate('tanggal', $tanggal)
                    ->first();

                if ($absensi) {
                    $riwayat = AbsensiDetail::with('siswa')
                        ->where('absensi_id', $absensi->id)
                        ->get();
                }
            }

            // ✏️ MODE INPUT ABSENSI
            if ($aksi == 'input') {

                $kelasAktif = Kelas::findOrFail($request->kelas_id);

                $siswa = Siswa::where('kelas_id', $request->kelas_id)->get();
            }
        }

        return view('guru.absensi.index', compact(
            'kelas',
            'mapel',
            'siswa',
            'kelasAktif',
            'riwayat'
        ));
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required',
            'mapel_id' => 'required',
            'absensi' => 'required|array'
        ]);

        $absensi = Absensi::firstOrCreate([
            'kelas_id' => $request->kelas_id,
            'mapel_id' => $request->mapel_id,
            'tanggal' => $request->tanggal,
        ], [
            'guru_id' => auth()->user()->guru->id
        ]);

        foreach ($request->absensi as $siswaId => $data) {

            AbsensiDetail::updateOrCreate(
                [
                    'absensi_id' => $absensi->id,
                    'siswa_id' => $siswaId
                ],
                [
                    'status' => $data['status'],
                    'keterangan' => $data['keterangan'] ?? null
                ]
            );
        }

        return redirect()->back()->with('success', 'Absensi berhasil disimpan');
    }

 public function update(Request $request, $id)
{
    $request->validate([
        'status' => 'required'
    ]);

    $detail = AbsensiDetail::findOrFail($id);

    $detail->update([
        'status' => $request->status,
        'keterangan' => $request->keterangan
    ]);

    return back()->with('success', 'Absensi berhasil diupdate');
}
}