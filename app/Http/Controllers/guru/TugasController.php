<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tugas;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\PengumpulanTugas;
use App\Models\Jadwal; // 🔥 WAJIB
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Siswa;

class TugasController extends Controller
{
   public function index()
{
    $guru = auth()->user()->guru;

    $tugas = Tugas::with(['kelas', 'mapel'])
        ->withCount('pengumpulan') // 🔥 hitung jumlah yang kumpul
        ->where('guru_id', $guru->id)
        ->get();

    // 🔥 tambahkan total siswa per kelas
    foreach ($tugas as $t) {
        $t->total_siswa = Siswa::where('kelas_id', $t->kelas_id)->count();
    }

    return view('guru.tugas.index', compact('tugas'));
}

public function create()
{
    $kelas = Kelas::all();
    $guru = auth()->user()->guru;

    $mapel = $guru->mapelRel;

    return view('guru.tugas.create', compact('kelas', 'mapel'));
}

  public function store(Request $request)
{
    $guru = auth()->user()->guru;

    $request->validate([
        'kelas_id' => 'required',
        'judul' => 'required',
        'deadline' => 'required',
        'file' => 'nullable|mimes:pdf,doc,docx,ppt,pptx|max:2048'
    ]);

    $filePath = null;

    // 🔥 INI BAGIAN PALING PENTING
    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('tugas_file', 'public');
    }

    Tugas::create([
    'guru_id' => $guru->id,
    'kelas_id' => $request->kelas_id,
    'mapel_id' => $guru->mapel_id,
    'judul' => $request->judul,
    'deskripsi' => $request->deskripsi,
    'file' => $filePath,
    'deadline' => str_replace('T', ' ', $request->deadline),
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
public function update(Request $request, $id)
{
    $request->validate([
        'judul' => 'required',
        'kelas_id' => 'required',
        'deadline' => 'required'
    ]);

    $tugas = Tugas::findOrFail($id);

    $tugas->update([
        'judul' => $request->judul,
        'kelas_id' => $request->kelas_id,
        'deskripsi' => $request->deskripsi,
        'deadline' => $request->deadline,
    ]);

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
    $tugas = Tugas::with(['pengumpulan.siswa'])->findOrFail($id);

    $deadline = Carbon::parse($tugas->deadline);

    foreach ($tugas->pengumpulan as $p) {
        $waktu = Carbon::parse($p->created_at);

        if ($waktu->gt($deadline)) {
            $p->status = 'telat';
        } else {
            $p->status = 'tepat';
        }
    }

    return view('guru.tugas.pengumpulan', compact('tugas'));
}

public function nilai(Request $request, $id)
{
    $request->validate([
        'nilai' => 'required|integer|min:0|max:100',
        'komentar' => 'nullable'
    ]);

    $pengumpulan = \App\Models\PengumpulanTugas::findOrFail($id);

    $pengumpulan->update([
        'nilai' => $request->nilai,
        'komentar' => $request->komentar
    ]);

    return back()->with('success', 'Nilai berhasil disimpan');
}
}