<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

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
use App\Http\Controllers\Guru\JadwalController as GuruJadwal;
use App\Http\Controllers\Guru\AbsensiController;
use App\Http\Controllers\Guru\NilaiController as GuruNilai;
use App\Http\Controllers\Guru\TugasController;
use App\Models\Jadwal;
use App\Http\Controllers\Guru\MapelController;


// ================= SISWA =================
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;
use App\Http\Controllers\Siswa\JadwalController as SiswaJadwal;
use App\Http\Controllers\Siswa\AbsensiController as SiswaAbsensi;
use App\Http\Controllers\Siswa\NilaiController as SiswaNilai;
use App\Http\Controllers\Siswa\ProfileController as SiswaProfile;
use App\Http\Controllers\Siswa\AbsensiController as SiswaAbsensiController;

//=================otp=================

use App\Http\Controllers\Auth\OtpController;

use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

use App\Http\Controllers\Siswa\UjianController;


use App\Http\Controllers\Guru\UjianController as GuruUjian;
use App\Http\Controllers\Siswa\UjianController as SiswaUjian;
/*
|----------------------------------------
| ROOT
|----------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

/*
|----------------------------------------
| LOGIN
|----------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

/*
|----------------------------------------
| LOGOUT
|----------------------------------------
*/
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');

/*
|----------------------------------------
| FORCE PASSWORD
|----------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/force-password', function () {
        return view('auth.force-password');
    })->name('force.password');

    Route::post('/force-password', [AuthController::class, 'updatePassword'])
        ->name('force.password.update');
});

/*
|----------------------------------------
| ADMIN
|----------------------------------------
*/
Route::middleware(['auth', 'force.password'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // 🔥 /admin langsung ke dashboard
        Route::get('/', [AdminDashboard::class, 'index']);

        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

        Route::resource('guru', GuruController::class);
        Route::resource('siswa', SiswaController::class);
        Route::resource('mapel', MataPelajaranController::class);
        Route::resource('kelas', KelasController::class);
        Route::resource('jadwal', AdminJadwal::class);

        // 🔥 route tambahan
        Route::get('jadwal/grid', [AdminJadwal::class, 'grid'])->name('jadwal.grid');

        // PROFILE
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

        // STATUS
        Route::get('/guru/{id}/nonaktif', [GuruController::class, 'nonaktif'])->name('guru.nonaktif');
        Route::get('/guru/{id}/aktifkan', [GuruController::class, 'aktifkan'])->name('guru.aktifkan');

            // Route::get('/siswa/{id}/nonaktif', [SiswaController::class, 'nonaktif'])->name('siswa.nonaktif');
        // Route::post('/nonaktif/{id}', [SiswaController::class, 'nonaktif'])
        // ->name('admin.siswa.nonaktif');
        // Route::get('/siswa/{id}/aktifkan', [SiswaController::class, 'aktifkan'])->name('siswa.aktifkan');

        Route::post('/siswa/bulk/nonaktif', [SiswaController::class, 'bulkNonaktif'])->name('siswa.bulkNonaktif');
    });

    Route::prefix('admin')->name('admin.')->group(function () {

    Route::post('/siswa/nonaktif/{id}', [SiswaController::class, 'nonaktif'])
        ->name('siswa.nonaktif');

    Route::get('/siswa/aktifkan/{id}', [SiswaController::class, 'aktifkan'])
        ->name('siswa.aktifkan');

        

});

/*
|----------------------------------------
| GURU
|----------------------------------------
*/
Route::middleware(['auth', 'force.password'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {

        Route::get('/', [GuruDashboard::class, 'index']);
        Route::get('/dashboard', [GuruDashboard::class, 'index'])->name('dashboard');

        Route::get('/jadwal', [GuruJadwal::class, 'index'])->name('jadwal');

        // =========================
        // ✅ ABSENSI (FINAL)
        // =========================
        Route::get('/absensi', [AbsensiController::class, 'index'])
            ->name('absensi');

        Route::post('/absensi/simpan', [AbsensiController::class, 'simpan'])
            ->name('absensi.simpan');


        // =========================
        // NILAI
        // =========================
        Route::get('/nilai', [GuruNilai::class, 'index'])->name('nilai.index');
        Route::get('/nilai/input', [GuruNilai::class, 'inputNilai'])->name('nilai.input');
        Route::get('/get-siswa/{id}', [GuruNilai::class, 'getSiswaByKelas'])->name('get.siswa');
        Route::post('/nilai/store-batch', [GuruNilai::class, 'storeBatch'])->name('nilai.storeBatch');
        Route::get('/nilai/{id}/edit', [GuruNilai::class, 'edit'])->name('nilai.edit');
        Route::put('/nilai/{id}', [GuruNilai::class, 'update'])->name('nilai.update');

        // =========================
        // TUGAS
        // =========================
        Route::resource('tugas', TugasController::class);

        Route::get('/tugas/{id}/download', [TugasController::class, 'download'])
            ->name('tugas.download');

        Route::get('/tugas/{id}/pengumpulan', [TugasController::class, 'pengumpulan'])
            ->name('tugas.pengumpulan');

        Route::post('/pengumpulan/{id}/nilai', [TugasController::class, 'nilai'])
            ->name('tugas.nilai');

        // =========================
        // MAPEL
        // =========================
        Route::get('/get-mapel-by-kelas/{id}', [MapelController::class, 'getByKelas'])
            ->name('get.mapel');
    });


//==================otp============
// Route::post('/send-otp', [OtpController::class, 'sendOtp'])->name('send.otp');
// Route::post('/login-otp', [OtpController::class, 'loginOtp'])->name('login.otp');
// Route::post('/send-otp-login', [OtpController::class, 'sendOtp'])
//     ->name('send.otp.login');
  Route::post('/send-otp', [OtpController::class, 'sendOtp'])->name('send.otp');
  Route::post('/login-otp', [OtpController::class, 'loginOtp'])->name('login.otp');

  // form email
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

// kirim email
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

// form reset
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

// simpan password baru
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
    ->name('password.update');


  Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/forgot-password', [AuthController::class, 'sendOtp'])
    ->name('password.email');
Route::get('/verify-otp', [AuthController::class, 'showVerifyOtp'])
    ->name('verify.otp.form');

Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])
    ->name('verify.otp');

// FORM RESET PASSWORD (GET)
Route::get('/reset-password', [AuthController::class, 'showResetPassword'])
    ->name('reset.password');

// PROSES RESET PASSWORD (POST)
Route::post('/reset-password', [AuthController::class, 'resetPassword'])
    ->name('password.update');

    Route::post('/reset-password', [AuthController::class, 'resetPassword'])
    ->name('password.update');

/*
|----------------------------------------
| SISWA
|----------------------------------------
*/
use App\Http\Controllers\Siswa\TugasController as SiswaTugasController;

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

        // ✅ SCAN QR
        Route::get('/absen/{token}', [SiswaAbsensi::class, 'scan'])
            ->name('absensi.scan');

        // ✅ SUBMIT HADIR
        Route::post('/absen/hadir', [SiswaAbsensi::class, 'hadir'])
            ->name('absensi.hadir');

        // ================= TUGAS =================
        Route::get('/tugas', [SiswaTugasController::class, 'index'])->name('tugas.index');
        Route::get('/tugas/{id}/kumpul', [SiswaTugasController::class, 'kumpul'])->name('tugas.kumpul');
        Route::post('/tugas/{id}/kumpul', [SiswaTugasController::class, 'store'])->name('tugas.store');
    });

Route::middleware(['auth'])->group(function () {

    Route::prefix('guru')->name('guru.')->group(function () {

        Route::get('/ujian', [\App\Http\Controllers\Guru\UjianController::class, 'index'])->name('ujian.index');

        Route::get('/ujian/create', [\App\Http\Controllers\Guru\UjianController::class, 'create'])->name('ujian.create');

        Route::post('/ujian/store', [\App\Http\Controllers\Guru\UjianController::class, 'store'])->name('ujian.store');

        Route::get('/ujian/{id}/soal', [\App\Http\Controllers\Guru\UjianController::class, 'soal'])->name('ujian.soal');

        Route::post('/ujian/{id}/soal', [\App\Http\Controllers\Guru\UjianController::class, 'storeSoal'])->name('ujian.storeSoal');

//         Route::get('/guru/ujian/{id}/soal', [UjianController::class, 'soal']);
// Route::post('/guru/ujian/{id}/soal', [UjianController::class, 'storeSoal']);

    });

});

Route::middleware(['auth'])->prefix('siswa')->group(function () {

    Route::get('/ujian', [UjianController::class, 'index'])
        ->name('siswa.ujian.index');

    Route::get('/ujian/{id}/kerjakan', [UjianController::class, 'kerjakan'])
        ->name('siswa.ujian.kerjakan');

    Route::post('/ujian/{id}/submit', [UjianController::class, 'submit'])
        ->name('siswa.ujian.submit');

});

/*
|----------------------------------------
| TEST EMAIL
|----------------------------------------
*/
Route::get('/test-email', function () {
    Mail::raw('Tes email berhasil', function ($message) {
        $message->to('EMAIL_KAMU@gmail.com')
            ->subject('Test Email Laravel');
    });

    return 'Email terkirim!';
});
