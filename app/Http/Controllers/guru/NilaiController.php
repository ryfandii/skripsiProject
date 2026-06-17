<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use App\Models\Kelas;

class NilaiController extends Controller
{
    // ── INDEX: Tampilkan menu nilai guru ──────────────────────────────
    public function index(Request $request)
    {
        $user     = auth()->user();
        $mapel_id = $user->mapel_id;
        $kelas    = Kelas::all();

        // Filter kelas
        $query = Nilai::with(['siswa.kelas', 'mapel'])
            ->where('mapel_id', $mapel_id);

        if ($request->kelas_id) {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('kelas_id', $request->kelas_id);
            });
        }

        // Filter siswa (opsional)
        if ($request->siswa_id) {
            $query->where('siswa_id', $request->siswa_id);
        }

        $nilai = $query->get();

        // Siswa berdasarkan kelas yang dipilih (untuk dropdown filter siswa)
        $siswaList = collect();
        if ($request->kelas_id) {
            $siswaList = Siswa::where('kelas_id', $request->kelas_id)->get();
        }

        return view('guru.nilai.index', compact('nilai', 'kelas', 'siswaList'));
    }

    // ── HITUNG RATA-RATA: simpan nilai_akhir ke kolom rata ──────────
    public function hitungRata(Request $request)
{
    $request->validate([
        'kelas_id' => 'required',
    ]);

    $user     = auth()->user();
    $mapel_id = $user->mapel_id;

    // ── BARU: Hitung nilai_tugas otomatis dari pengumpulan_tugas ──
    // Ambil semua tugas mapel ini di kelas ini
    $semuaTugas = \App\Models\Tugas::where('mapel_id', $mapel_id)
        ->where('kelas_id', $request->kelas_id)
        ->get();

    // Ambil semua siswa di kelas ini
    $siswaList = \App\Models\Siswa::where('kelas_id', $request->kelas_id)->get();

    foreach ($siswaList as $siswa) {
        $totalNilai  = 0;
        $jumlahTugas = count($semuaTugas);

        if ($jumlahTugas > 0) {
            foreach ($semuaTugas as $tugas) {
                $pengumpulan = \App\Models\PengumpulanTugas::where('tugas_id', $tugas->id)
                    ->where('siswa_id', $siswa->id)
                    ->first();

                // Sudah kumpul dan dinilai → pakai nilainya, selain itu → 0
                if ($pengumpulan && $pengumpulan->nilai !== null) {
                    $totalNilai += $pengumpulan->nilai;
                } else {
                    $totalNilai += 0;
                }
            }

            $rata_tugas = round($totalNilai / $jumlahTugas, 2);

            // Simpan ke kolom nilai_tugas
            \App\Models\Nilai::updateOrCreate(
                ['siswa_id' => $siswa->id, 'mapel_id' => $mapel_id],
                ['nilai_tugas' => $rata_tugas]
            );
        }
    }
    // ── SELESAI hitung nilai_tugas otomatis ──

    // Sekarang hitung rata-rata akhir (tugas + uts + uas)
    $nilaiList = \App\Models\Nilai::with('siswa')
        ->where('mapel_id', $mapel_id)
        ->whereHas('siswa', fn($q) => $q->where('kelas_id', $request->kelas_id))
        ->get();

    foreach ($nilaiList as $n) {
        $parts = [];
        if ($n->nilai_tugas !== null) $parts[] = (float) $n->nilai_tugas;
        if ($n->nilai_uts   !== null) $parts[] = (float) $n->nilai_uts;
        if ($n->nilai_uas   !== null) $parts[] = (float) $n->nilai_uas;

        if (count($parts) > 0) {
            $rata = round(array_sum($parts) / count($parts), 2);
            $n->update(['nilai_akhir' => $rata]);
        }
    }

    return redirect()->route('guru.nilai.index', ['kelas_id' => $request->kelas_id])
        ->with('success', 'Rata-rata berhasil dihitung!');
}
    // ── HALAMAN INPUT NILAI PER KELAS ────────────────────────────────
    public function inputNilai()
    {
        $kelas = Kelas::all();
        $mapel = MataPelajaran::find(auth()->user()->mapel_id);

        if (!$mapel) {
            return back()->with('error', 'Mapel belum disetting!');
        }

        return view('guru.nilai.input', compact('kelas', 'mapel'));
    }

    // ── AJAX: ambil siswa berdasarkan kelas ─────────────────────────
    public function getSiswaByKelas($id)
    {
        $siswa = Siswa::where('kelas_id', $id)->get();
        return response()->json($siswa);
    }

    // ── SIMPAN NILAI BATCH ───────────────────────────────────────────
    public function storeBatch(Request $request)
    {
        $request->validate([
            'mapel_id' => 'required',
            'nilai'    => 'required|array',
        ]);

        foreach ($request->nilai as $siswa_id => $nilai) {
            if ($nilai != null) {
                Nilai::updateOrCreate(
                    ['siswa_id' => $siswa_id, 'mapel_id' => $request->mapel_id],
                    ['nilai'    => $nilai]
                );
            }
        }

        return redirect()->route('guru.nilai.index')
            ->with('success', 'Nilai berhasil disimpan');
    }

    // ── MASUKKAN NILAI TUGAS DARI MENU TUGAS ─────────────────────────
    // Dipanggil dari tombol di halaman tugas / rekap rata-rata
    public function masukkanNilaiTugas(Request $request)
    {
        $request->validate([
            'siswa_id'    => 'required',
            'nilai_tugas' => 'required|numeric|min:0|max:100',
        ]);

        $user     = auth()->user();
        $mapel_id = $user->mapel_id;

        Nilai::updateOrCreate(
            ['siswa_id' => $request->siswa_id, 'mapel_id' => $mapel_id],
            ['nilai_tugas' => $request->nilai_tugas]
        );

        return back()->with('success', 'Nilai tugas berhasil dimasukkan ke menu nilai!');
    }

    // ── MASUKKAN NILAI UJIAN DARI MENU UJIAN ─────────────────────────
    // Dipanggil dari tombol di menu ujian per ujian (UTS/UAS)
    public function masukkanNilaiUjian(Request $request)
    {
        $request->validate([
            'ujian_id' => 'required',
        ]);

        $ujian    = \App\Models\Ujian::with('kelas')->findOrFail($request->ujian_id);
        $mapel_id = $ujian->mapel_id;
        $jenis    = strtolower($ujian->jenis); // 'uts' atau 'uas'
        $kolom    = 'nilai_' . $jenis;          // 'nilai_uts' atau 'nilai_uas'

        // Ambil semua hasil ujian ini
        $hasilList = \App\Models\Hasil::where('ujian_id', $ujian->id)->get();

        foreach ($hasilList as $h) {
            Nilai::updateOrCreate(
                ['siswa_id' => $h->siswa_id, 'mapel_id' => $mapel_id],
                [$kolom => $h->nilai]
            );
        }

        return back()->with('success', 'Nilai ' . strtoupper($jenis) . ' berhasil dikirim ke menu nilai!');
    }

    // ── KIRIM NILAI KE SISWA ─────────────────────────────────────────
public function kirimKeSiswa(Request $request)
{
    $request->validate([
        'kelas_id' => 'required',
    ]);

    $user     = auth()->user();
    $mapel_id = $user->mapel_id;

    $nilaiList = Nilai::with('siswa')
        ->where('mapel_id', $mapel_id)
        ->whereHas('siswa', fn($q) => $q->where('kelas_id', $request->kelas_id))
        ->get();

    foreach ($nilaiList as $n) {
        $n->update(['sudah_kirim' => true]); // ✅ ganti is_published → sudah_kirim
    }

    return back()->with('success', 'Nilai berhasil dikirim ke siswa!');
}

    // ── EDIT ─────────────────────────────────────────────────────────
    public function edit($id)
    {
        $nilai = Nilai::with(['siswa', 'mapel'])->findOrFail($id);
        return view('guru.nilai.edit', compact('nilai'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nilai_tugas' => 'nullable|numeric|min:0|max:100',
            'nilai_uts'   => 'nullable|numeric|min:0|max:100',
            'nilai_uas'   => 'nullable|numeric|min:0|max:100',
        ]);

        $nilai = Nilai::findOrFail($id);
        $nilai->update($request->only(['nilai_tugas', 'nilai_uts', 'nilai_uas']));

        return redirect()->route('guru.nilai.index')
            ->with('success', 'Nilai berhasil diupdate');
    }

    public function destroy($id)
    {
        Nilai::findOrFail($id)->delete();
        return redirect()->route('guru.nilai.index')
            ->with('success', 'Data nilai berhasil dihapus');
    }
}