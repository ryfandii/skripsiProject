<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\AbsensiDetail;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use Carbon\Carbon;

class AbsensiController extends Controller
{
public function index(Request $request)
{
    $kelas = Kelas::all();
    $mapel = MataPelajaran::find(auth()->user()->guru->mapel_id);
     // 🔥 VALIDASI DI SINI
    if (!$mapel) {
        return back()->with('error', 'Mapel guru belum diatur!');
    }
    $siswa = null;
    $kelasAktif = null;
    $riwayat = null;

    if ($request->kelas_id && $request->mapel_id) {

        $kelasAktif = Kelas::findOrFail($request->kelas_id);

        $siswa = Siswa::where('kelas_id', $request->kelas_id)->get();

        // 🔥 ambil absensi hari ini
        $absensi = Absensi::where('kelas_id', $request->kelas_id)
            ->where('mapel_id', $request->mapel_id)
            ->whereDate('tanggal', now())
            ->first();

        if ($absensi) {
            $riwayat = AbsensiDetail::with('siswa')
                ->where('absensi_id', $absensi->id)
                ->get();
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

  public function buka(Request $request)
{
    $request->validate([
        'kelas_id' => 'required',
        'mapel_id' => 'required'
    ]);

    $absensi = Absensi::create([
        'guru_id' => auth()->user()->guru->id,
        'kelas_id' => $request->kelas_id,
        'mapel_id' => $request->mapel_id,
        'tanggal' => now(),
    ]);

    return redirect()->route('guru.absensi.kelola', $absensi->id);
}

    public function kelola($id)
    {
        $absensi = Absensi::findOrFail($id);

        $siswa = Siswa::where('kelas_id', $absensi->kelas_id)->get();

        return view('guru.absensi.kelola', compact('absensi', 'siswa'));
    }

  public function simpan(Request $request)
{
    $request->validate([
        'kelas_id' => 'required',
        'mapel_id' => 'required',
        'absensi' => 'required|array'
    ]);

    // 🔥 CEK / BUAT absensi hari ini
    $absensi = Absensi::firstOrCreate([
        'kelas_id' => $request->kelas_id,
        'mapel_id' => $request->mapel_id,
        'tanggal' => now()->toDateString(),
    ], [
        'guru_id' => auth()->user()->guru->id
    ]);

    // 🔥 SIMPAN DETAIL
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

    public function tutup($id)
    {
        Absensi::findOrFail($id)->update(['dibuka' => false]);

        return back()->with('success', 'Absensi ditutup');
    }

    public function delete($id)
{
    AbsensiDetail::findOrFail($id)->delete();

    return back()->with('success', 'Data dihapus');
}
}