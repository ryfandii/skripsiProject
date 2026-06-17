<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Services\OtpService;

class SiswaController extends Controller
{
    // ================= INDEX =================
    public function index(Request $request)
    {
        $kelas = Kelas::all();

        $query = Siswa::with(['kelas', 'user']);

        if ($request->kelas_id) {
            $query->where('kelas_id', $request->kelas_id);
        }

        $siswa = $query->get();

        return view('admin.siswa.index', compact('siswa', 'kelas'));
    }

    // ================= CREATE =================
    public function create()
    {
        $kelas = Kelas::all();
        return view('admin.siswa.create', compact('kelas'));
    }

    // ================= STORE =================
    public function store(Request $request)
    {

    \Log::info('STORE DIPANGGIL');
    
    if ($request->has('telepon')) {
        $telepon = $request->telepon;
        // Hapus tanda plus jika ada (+62 -> 62)
        $telepon = ltrim($telepon, '+');
        // Jika tipenya string diawali dengan 62, ganti jadi 0
        if (strpos($telepon, '62') === 0) {
            $telepon = '0' . substr($telepon, 2);
        }
        // Masukkan kembali nilai yang sudah rapi ke dalam request
        $request->merge(['telepon' => $telepon]);
    }
    
        $request->validate([
        'nama' => 'required',
        'jenis_kelamin' => 'required',
        'nama_ortu' => 'required',
        'nis' => 'required|unique:siswa,nis',
        'kelas_id' => 'required',
        'alamat' => 'required',
        'telepon' => 'required',
        'email' => 'required|email|unique:users,email',
    ]);

   // 2. CEK TAMBAHAN (ANTI DOUBLE SUBMIT)
    if (User::where('email', $request->email)->exists()) {
        return back()->with('error', 'Email sudah digunakan!');
    }

$siswa = Siswa::create([
    'nama' => $request->nama,
    'jenis_kelamin' => $request->jenis_kelamin,
    'nama_ortu' => $request->nama_ortu,
    'nis' => $request->nis,
    'kelas_id' => $request->kelas_id,
    'alamat' => $request->alamat,
    'telepon' => $request->telepon,
    'status' => 'aktif'
]);

        // simpan user login
      $user = User::create([
    'name' => $request->nama,
    'email' => $request->email,
    'password' => Hash::make('12345678'), // ðŸ”¥ default
    'role' => 'siswa', // atau guru
    'siswa_id' => $siswa->id,
    'is_default_password' => true // ðŸ”¥ WAJIB
]);

/** @var \App\Models\User $user */
app(OtpService::class)->send($user);

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Siswa + akun login berhasil dibuat');
    }

    // ================= EDIT =================
    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();
        return view('admin.siswa.edit', compact('siswa', 'kelas'));
    }

    // ================= UPDATE =================
    public function update(Request $request, Siswa $siswa)
    {
        
        if ($request->has('telepon')) {
        $telepon = $request->telepon;
        // Hapus tanda plus jika ada (+62 -> 62)
        $telepon = ltrim($telepon, '+');
        // Jika tipenya string diawali dengan 62, ganti jadi 0
        if (strpos($telepon, '62') === 0) {
            $telepon = '0' . substr($telepon, 2);
        }
        // Masukkan kembali nilai yang sudah rapi ke dalam request
        $request->merge(['telepon' => $telepon]);
    }
    
        $request->validate([
    'nama' => 'required',
    'jenis_kelamin' => 'required',
    'nama_ortu' => 'required',
    'nis' => 'required|unique:siswa,nis,' . $siswa->id,
    'kelas_id' => 'required',
    'alamat' => 'required',
    'telepon' => 'required',
]);

$siswa->update([
    'nama' => $request->nama,
    'jenis_kelamin' => $request->jenis_kelamin,
    'nama_ortu' => $request->nama_ortu,
    'nis' => $request->nis,
    'kelas_id' => $request->kelas_id,
    'alamat' => $request->alamat,
    'telepon' => $request->telepon,
]);

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    // ================= DELETE =================
    public function destroy(Siswa $siswa)
    {
        // hapus user terkait
        User::where('siswa_id', $siswa->id)->delete();

        $siswa->delete();

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }

    // ================= NONAKTIF =================
    public function nonaktif(Request $request, $id)
    {
        $request->validate([
            'alasan' => 'required|min:5'
        ]);

        $siswa = Siswa::findOrFail($id);

        $siswa->update([
            'status' => 'nonaktif',
            'alasan_nonaktif' => $request->alasan
        ]);

        return back()->with('success', 'Siswa dinonaktifkan');
    }

    // ================= AKTIFKAN =================
    public function aktifkan($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->status = 'aktif';
        $siswa->save();

        return back()->with('success', 'Siswa diaktifkan');
    }

    // ================= BULK NONAKTIF =================
    public function bulkNonaktif(Request $request)
{
    if (!$request->ids) {
        return back()->with('error', 'Pilih minimal 1 siswa!');
    }

    Siswa::whereIn('id', $request->ids)
        ->update(['status' => 'nonaktif']);

    return back()->with('success', 'Siswa berhasil dinonaktifkan');
}

    
}