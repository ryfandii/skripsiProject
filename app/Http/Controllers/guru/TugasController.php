<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tugas;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\PengumpulanTugas;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Siswa;

class TugasController extends Controller
{
    public function index()
{
    $guru = auth()->user()->guru;

    $tugas = Tugas::with(['kelas', 'mapel'])
        ->withCount('pengumpulan')
        ->where('guru_id', $guru->id)
        ->get();

    foreach ($tugas as $t) {
        $t->total_siswa = Siswa::where('kelas_id', $t->kelas_id)->count();
    }

    $tugasIds = $tugas->pluck('id');

    // Kelompokkan tugas berdasarkan kelas
    // Format: { "X IPA 1": [ {tugas_id, ...}, ... ], ... }
    $tugasPerKelas = $tugas->groupBy(fn($t) => $t->kelas->nama_kelas ?? 'Tidak Diketahui');

    // Ambil semua pengumpulan (termasuk yang belum dinilai)
    $semuaPengumpulan = \App\Models\PengumpulanTugas::with(['siswa'])
        ->whereIn('tugas_id', $tugasIds)
        ->get();

    $rekapPerKelas = collect();

    foreach ($tugasPerKelas as $namaKelas => $tugasDiKelas) {
        $tugasIdsKelas = $tugasDiKelas->pluck('id')->toArray();

        // Ambil semua siswa di kelas ini
        $kelasId   = $tugasDiKelas->first()->kelas_id;
        $semuaSiswa = Siswa::where('kelas_id', $kelasId)->get();

        $rekapSiswa = collect();

        foreach ($semuaSiswa as $siswa) {
            $totalNilai   = 0;
            $jumlahTugas  = count($tugasIdsKelas); // total tugas di kelas ini

            foreach ($tugasIdsKelas as $tid) {
                $pengumpulan = $semuaPengumpulan
                    ->where('tugas_id', $tid)
                    ->where('siswa_id', $siswa->id)
                    ->first();

                if ($pengumpulan && $pengumpulan->nilai !== null) {
                    // Sudah kumpul dan sudah dinilai
                    $totalNilai += $pengumpulan->nilai;
                } else {
                    // Belum kumpul ATAU sudah kumpul tapi belum dinilai → 0
                    $totalNilai += 0;
                }
            }

            $rata = $jumlahTugas > 0
                ? round($totalNilai / $jumlahTugas, 1)
                : 0;

            // Buat inisial nama
            $nameParts = explode(' ', $siswa->nama ?? 'S');
            $inisial   = strtoupper(substr($nameParts[0], 0, 1))
                       . (isset($nameParts[1]) ? strtoupper(substr($nameParts[1], 0, 1)) : '');

            $rekapSiswa->push([
                'id'           => $siswa->id,
                'nama'         => $siswa->nama,
                'inisial'      => $inisial,
                'jumlah_tugas' => $jumlahTugas,
                'rata_rata'    => $rata,
            ]);
        }

        $rekapPerKelas[$namaKelas] = $rekapSiswa->values();
    }

    // Flat list kalau masih dipakai
    $rekapNilai = $rekapPerKelas->flatten(1)->values();

    return view('guru.tugas.index', compact('tugas', 'rekapNilai', 'rekapPerKelas'));
}

    public function getMapelByKelas($id)
    {
        $guruId = auth()->user()->guru->id;

        $mapel = Jadwal::where('kelas_id', $id)
            ->where('guru_id', $guruId)
            ->join('mata_pelajarans', 'jadwals.mata_pelajaran_id', '=', 'mata_pelajarans.id')
            ->select('mata_pelajarans.id', 'mata_pelajarans.nama_mapel')
            ->distinct()
            ->get();

        return response()->json($mapel);
    }

    public function show($id)
    {
        $tugas = Tugas::with(['kelas', 'mapel'])->findOrFail($id);

        return view('guru.tugas.show', compact('tugas'));
    }

    public function edit($id)
    {
        $tugas = Tugas::findOrFail($id);
        $kelas = Kelas::all();

        return view('guru.tugas.edit', compact('tugas', 'kelas'));
    }

   // SESUDAH
public function update(Request $request, $id)
{
    $request->validate([
        'judul'    => 'required',
        'kelas_id' => 'required',
        'deadline' => 'required',
        'file'     => 'nullable|max:10240', // ✅ validasi file
    ], [
        'file.max' => 'Ukuran file maksimal 10MB.',
    ]);

    $tugas = Tugas::findOrFail($id);

    $updateData = [
        'judul'     => $request->judul,
        'kelas_id'  => $request->kelas_id,
        'deskripsi' => $request->deskripsi,
        'deadline'  => $request->deadline,
    ];

    // ✅ Jika ada file baru diupload
    if ($request->hasFile('file')) {
        // Hapus file lama jika ada
        if ($tugas->file && Storage::disk('public')->exists($tugas->file)) {
            Storage::disk('public')->delete($tugas->file);
        }
        // Simpan file baru
        $updateData['file'] = $request->file('file')->store('tugas_file', 'public');
    }

    $tugas->update($updateData);

    return redirect()->route('guru.tugas.index')
        ->with('success', 'Tugas berhasil diupdate');
}
    public function download($id)
    {
        $tugas = Tugas::findOrFail($id);

        if (!$tugas->file) {
            abort(404, 'File tidak ditemukan');
        }

        $path = storage_path('app/public/' . $tugas->file);

        if (!file_exists($path)) {
            abort(404, 'File tidak ada di storage');
        }

        return response()->download($path);
    }

    public function pengumpulan($id)
    {
        $tugas    = Tugas::with(['pengumpulan.siswa'])->findOrFail($id);
        $deadline = Carbon::parse($tugas->deadline);

        foreach ($tugas->pengumpulan as $p) {
            $waktu    = Carbon::parse($p->created_at);
            $p->status = $waktu->gt($deadline) ? 'telat' : 'tepat';
        }

        $pengumpulanJson = $tugas->pengumpulan->map(function ($p) {
            return [
                'nama'    => $p->siswa->nama ?? '-',
                'inisial' => strtoupper(substr($p->siswa->nama ?? 'S', 0, 1)),
                'nilai'   => $p->nilai,
            ];
        });

        return view('guru.tugas.pengumpulan', compact('tugas', 'pengumpulanJson'));
    }

    public function nilai(Request $request, $id)
    {
        $request->validate([
            'nilai'    => 'required|integer|min:0|max:100',
            'komentar' => 'nullable',
        ]);

        $pengumpulan = \App\Models\PengumpulanTugas::findOrFail($id);

        $pengumpulan->update([
            'nilai'    => $request->nilai,
            'komentar' => $request->komentar,
        ]);

        return back()->with('success', 'Nilai berhasil disimpan');
    }
}