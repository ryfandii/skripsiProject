<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;

// ================= ADMIN =================
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\MataPelajaranController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\JadwalController as AdminJadwal;
use App\Http\Controllers\Admin\ProfileController;

// ================= GURU =================
use App\Http\Controllers\Guru\DashboardController as GuruDashboard;
use App\Http\Controllers\Guru\DashboardController;
use App\Http\Controllers\Guru\JadwalController as GuruJadwal;
use App\Http\Controllers\Guru\AbsensiController;
use App\Http\Controllers\Guru\NilaiController as GuruNilai;
use App\Http\Controllers\Guru\TugasController;
use App\Http\Controllers\Guru\MapelController;
use App\Http\Controllers\Guru\UjianController as GuruUjian;
use App\Models\Jadwal;

// ================= SISWA =================
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;
use App\Http\Controllers\Siswa\JadwalController as SiswaJadwal;
use App\Http\Controllers\Siswa\AbsensiController as SiswaAbsensi;
use App\Http\Controllers\Siswa\NilaiController as SiswaNilai;
use App\Http\Controllers\Siswa\ProfileController as SiswaProfile;
use App\Http\Controllers\Siswa\TugasController as SiswaTugasController;
use App\Http\Controllers\Siswa\UjianController as SiswaUjian;

// ================= AUTH TAMBAHAN =================
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| LOGIN & LOGOUT
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| OTP LOGIN
|--------------------------------------------------------------------------
*/
Route::post('/send-otp', [OtpController::class, 'sendOtp'])->name('send.otp');
Route::post('/login-otp', [OtpController::class, 'loginOtp'])->name('login.otp');

/*
|--------------------------------------------------------------------------
| FORCE PASSWORD
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/force-password', function () {
        return view('auth.force-password');
    })->name('force.password');

    Route::post('/force-password', [AuthController::class, 'updatePassword'])
        ->name('force.password.update');
});

/*
|--------------------------------------------------------------------------
| LUPA PASSWORD
|--------------------------------------------------------------------------
*/
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/forgot-password', [AuthController::class, 'sendOtp'])
    ->name('password.email');

Route::get('/verify-otp', [AuthController::class, 'showVerifyOtp'])
    ->name('verify.otp.form');

Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])
    ->name('verify.otp');

Route::get('/reset-password', [AuthController::class, 'showResetPassword'])
    ->name('reset.password.form');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])
    ->name('password.update');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'force.password'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', [AdminDashboard::class, 'index']);
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

        Route::resource('guru', GuruController::class);
        Route::resource('siswa', SiswaController::class);
        Route::resource('mapel', MataPelajaranController::class);
        Route::resource('kelas', KelasController::class);
        Route::resource('jadwal', AdminJadwal::class);

        Route::get('jadwal/grid', [AdminJadwal::class, 'grid'])->name('jadwal.grid');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

        Route::get('/guru/{id}/nonaktif', [GuruController::class, 'nonaktif'])->name('guru.nonaktif');
        Route::get('/guru/{id}/aktifkan', [GuruController::class, 'aktifkan'])->name('guru.aktifkan');

        Route::post('/siswa/bulk/nonaktif', [SiswaController::class, 'bulkNonaktif'])->name('siswa.bulkNonaktif');
    });

// Siswa nonaktif/aktifkan
Route::prefix('admin')->name('admin.')->group(function () {
    Route::post('/siswa/nonaktif/{id}', [SiswaController::class, 'nonaktif'])->name('siswa.nonaktif');
    Route::get('/siswa/aktifkan/{id}', [SiswaController::class, 'aktifkan'])->name('siswa.aktifkan');
});

/*
|--------------------------------------------------------------------------
| GURU
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'force.password'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {

        Route::get('/', [GuruDashboard::class, 'index']);
        Route::get('/dashboard', [GuruDashboard::class, 'index'])->name('dashboard');

        Route::get('/jadwal', [GuruJadwal::class, 'index'])->name('jadwal');

        // ABSENSI
        Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi');
        Route::post('/absensi/simpan', [AbsensiController::class, 'simpan'])->name('absensi.simpan');
        Route::put('/absensi/update/{id}', [AbsensiController::class, 'update'])->name('absensi.update');

        // NILAI
        // CATATAN: route dengan path statis (tanpa parameter) didaftarkan lebih dulu
        // agar Laravel tidak salah parsing saat ada route dengan {id}
        Route::get('/nilai', [GuruNilai::class, 'index'])->name('nilai.index');
        Route::get('/nilai/input', [GuruNilai::class, 'inputNilai'])->name('nilai.input');
        Route::get('/get-siswa/{id}', [GuruNilai::class, 'getSiswaByKelas'])->name('get.siswa');
        Route::post('/nilai/store-batch', [GuruNilai::class, 'storeBatch'])->name('nilai.storeBatch');
        Route::post('/nilai/masukkan-tugas', [GuruNilai::class, 'masukkanNilaiTugas'])->name('nilai.masukkanTugas');
        Route::post('/nilai/masukkan-ujian', [GuruNilai::class, 'masukkanNilaiUjian'])->name('nilai.masukkanUjian');
        Route::post('/nilai/hitung-rata', [GuruNilai::class, 'hitungRata'])->name('nilai.hitungRata');
        Route::post('/nilai/kirim-ke-siswa', [GuruNilai::class, 'kirimKeSiswa'])->name('nilai.kirimKeSiswa');
        Route::get('/nilai/{id}/edit', [GuruNilai::class, 'edit'])->name('nilai.edit');
        Route::put('/nilai/{id}', [GuruNilai::class, 'update'])->name('nilai.update');
        Route::delete('/nilai/{id}', [GuruNilai::class, 'destroy'])->name('nilai.destroy');

        // TUGAS
        Route::resource('tugas', TugasController::class);
        Route::get('/tugas/{id}/download', [TugasController::class, 'download'])->name('tugas.download');
        Route::get('/tugas/{id}/pengumpulan', [TugasController::class, 'pengumpulan'])->name('tugas.pengumpulan');
        Route::post('/pengumpulan/{id}/nilai', [TugasController::class, 'nilai'])->name('tugas.nilai');

        // MAPEL
        Route::get('/get-mapel-by-kelas/{id}', [MapelController::class, 'getByKelas'])->name('get.mapel');

        // UJIAN
        Route::get('/ujian', [GuruUjian::class, 'index'])->name('ujian.index');
        Route::get('/ujian/create', [GuruUjian::class, 'create'])->name('ujian.create');
        Route::post('/ujian/store', [GuruUjian::class, 'store'])->name('ujian.store');
        Route::get('/ujian/{id}/edit', [GuruUjian::class, 'edit'])->name('ujian.edit');
        Route::put('/ujian/{id}', [GuruUjian::class, 'update'])->name('ujian.update');
        Route::delete('/ujian/{id}', [GuruUjian::class, 'destroy'])->name('ujian.destroy');
        Route::get('/ujian/{id}/soal', [GuruUjian::class, 'soal'])->name('ujian.soal');
        Route::post('/ujian/{id}/soal', [GuruUjian::class, 'storeSoal'])->name('ujian.storeSoal');
        Route::post('/ujian/{id}/kirim', [GuruUjian::class, 'kirim'])->name('ujian.kirim');
    });

/*
|--------------------------------------------------------------------------
| SISWA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'force.password'])
    ->prefix('siswa')
    ->name('siswa.')
    ->group(function () {

        Route::get('/', [SiswaDashboard::class, 'index']);
        Route::get('/dashboard', [SiswaDashboard::class, 'index'])->name('dashboard');

        Route::get('/jadwal', [SiswaJadwal::class, 'index'])->name('jadwal');
        Route::get('/absensi', [SiswaAbsensi::class, 'index'])->name('absensi');
        Route::get('/nilai', [SiswaNilai::class, 'index'])->name('nilai');

        Route::get('/profile', [SiswaProfile::class, 'index'])->name('profile');
        Route::post('/profile', [SiswaProfile::class, 'update'])->name('profile.update');

        // QR Absensi
        Route::get('/absen/{token}', [SiswaAbsensi::class, 'scan'])->name('absensi.scan');
        Route::post('/absen/hadir', [SiswaAbsensi::class, 'hadir'])->name('absensi.hadir');

        // TUGAS
        Route::get('/tugas', [SiswaTugasController::class, 'index'])->name('tugas.index');
        Route::get('/tugas/{id}/kumpul', [SiswaTugasController::class, 'kumpul'])->name('tugas.kumpul');
        Route::post('/tugas/{id}/kumpul', [SiswaTugasController::class, 'store'])->name('tugas.store');

        // UJIAN
        Route::get('/ujian', [SiswaUjian::class, 'index'])->name('ujian.index');
        Route::get('/ujian/{id}/kerjakan', [SiswaUjian::class, 'kerjakan'])->name('ujian.kerjakan');
        Route::post('/ujian/{id}/submit', [SiswaUjian::class, 'submit'])->name('ujian.submit');
    });

/*
|--------------------------------------------------------------------------
| TEST EMAIL (hapus di production)
|--------------------------------------------------------------------------
*/
Route::get('/test-email', function () {
    Mail::raw('Tes email berhasil', function ($message) {
        $message->to('EMAIL_KAMU@gmail.com')->subject('Test Email Laravel');
    });
    return 'Email terkirim!';
});