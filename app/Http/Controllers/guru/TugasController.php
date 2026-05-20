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

        // -----------------------------------------------------------------
        // Rekap nilai dikelompokkan per KELAS (untuk filter JS di view)
        // Format: { "X IPA 1": [ {id, nama, inisial, jumlah_tugas, rata_rata}, … ], … }
        // -----------------------------------------------------------------
        $rekapPerKelas = \App\Models\PengumpulanTugas::with(['siswa', 'tugas.kelas'])
            ->whereIn('tugas_id', $tugasIds)
            ->whereNotNull('nilai')
            ->get()
            ->groupBy(function ($p) {
                // Kelompokkan berdasarkan nama kelas siswa
                return $p->tugas->kelas->nama_kelas ?? 'Tidak Diketahui';
            })
            ->map(function ($kelasGroup) {
                // Di dalam setiap kelas, kelompokkan lagi per siswa
                return $kelasGroup
                    ->groupBy('siswa_id')
                    ->map(function ($kumpulan) {
                        $siswa    = $kumpulan->first()->siswa;
                        $nilaiList = $kumpulan->pluck('nilai')->map(fn ($n) => (float) $n);
                        $rata      = round($nilaiList->avg(), 1);

                        return [
                            'id'           => $siswa->id ?? 0,
                            'nama'         => $siswa->nama ?? '-',
                            'inisial'      => strtoupper(substr($siswa->nama ?? 'S', 0, 1))
                                             . (isset(explode(' ', $siswa->nama ?? '')[1])
                                                ? strtoupper(substr(explode(' ', $siswa->nama)[1], 0, 1))
                                                : ''),
                            'jumlah_tugas' => $kumpulan->count(),
                            'rata_rata'    => $rata,
                        ];
                    })
                    ->values(); // reset key jadi array numerik
            });

        // Juga tetap sediakan $rekapNilai (flat) kalau masih dipakai view lain
        $rekapNilai = $rekapPerKelas->flatten(1)->values();

        return view('guru.tugas.index', compact('tugas', 'rekapNilai', 'rekapPerKelas'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        $guru  = auth()->user()->guru;
        $mapel = $guru->mapelRel;

        return view('guru.tugas.create', compact('kelas', 'mapel'));
    }

    public function store(Request $request)
    {
        $guru = auth()->user()->guru;

        $request->validate([
            'kelas_id' => 'required',
            'judul'    => 'required',
            'deadline' => 'required',
            'file' => 'nullable|max:10240',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('tugas_file', 'public');
        }

        Tugas::create([
            'guru_id'   => $guru->id,
            'kelas_id'  => $request->kelas_id,
            'mapel_id'  => $guru->mapel_id,
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file'      => $filePath,
            'deadline'  => str_replace('T', ' ', $request->deadline),
        ]);

        return redirect()->route('guru.tugas.index')
            ->with('success', 'Tugas berhasil dibuat');
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