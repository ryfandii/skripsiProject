<?php

use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Mail;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// ================= FORGOT PASSWORD =================
Route::prefix('auth')->middleware('guest')->group(function () {

    // ================= FORGOT PASSWORD =================
    
    Route::get('/forgot-password', [AuthController::class, 'showForgot'])
        ->name('forgot.password');

    Route::post('/send-otp', [AuthController::class, 'sendOtp'])
        ->name('send.otp');

    Route::get('/verify-otp', [AuthController::class, 'showVerifyOtp'])
        ->name('verify.otp.form');

    Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])
        ->name('verify.otp');

    Route::get('/reset-password', [AuthController::class, 'showResetPassword'])
        ->name('reset.password.form');

    Route::post('/reset-password', [AuthController::class, 'resetPassword'])
        ->name('reset.password');

    Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name('send.otp');
});

Route::get('/test-email', function () {
    Mail::raw('Tes email berhasil', function ($message) {
        $message->to('EMAIL_KAMU@gmail.com')
                ->subject('Test Email Laravel');
    });

    return 'Email terkirim!';
});

// ADMIN
Route::get('/admin', function () {
    return view('admin.dashboard');
});

// GURU
Route::get('/guru', function () {
    return view('guru.dashboard');
});

// SISWA
Route::get('/siswa', function () {
    return view('siswa.dashboard');
});
/*
|----------------------------------------
| FORCE PASSWORD (LOGIN SAJA)
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
| SEMUA HALAMAN (WAJIB FORCE PASSWORD)
|----------------------------------------
*/
Route::middleware(['auth', 'force.password'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    Route::resource('guru', GuruController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('mapel', MataPelajaranController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('jadwal', AdminJadwal::class);

    Route::get('jadwal-grid', [AdminJadwal::class, 'grid'])->name('jadwal.grid');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/guru/{id}/nonaktif', [GuruController::class, 'nonaktif'])->name('guru.nonaktif');
    Route::get('/guru/{id}/aktifkan', [GuruController::class, 'aktifkan'])->name('guru.aktifkan');

    Route::get('/siswa/{id}/nonaktif', [SiswaController::class, 'nonaktif'])->name('siswa.nonaktif');
    Route::get('/siswa/{id}/aktifkan', [SiswaController::class, 'aktifkan'])->name('siswa.aktifkan');

    Route::post('/siswa/bulk/nonaktif', [SiswaController::class, 'bulkNonaktif'])
        ->name('siswa.bulkNonaktif');

});
// ================= FORGOT PASSWORD =================
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
});

Route::post('/forgot-password', [AuthController::class, 'sendOtp']);

Route::get('/verify-otp', function () {
    return view('auth.verify-otp');
});

Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

Route::get('/reset-password', function () {
    return view('auth.reset-password');
});

Route::post('/reset-password', [AuthController::class, 'resetPassword']);
/*
|----------------------------------------
| ROOT
|----------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\MataPelajaranController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\JadwalController as AdminJadwal;
use App\Http\Controllers\Admin\ProfileController;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    Route::resource('guru', GuruController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('mapel', MataPelajaranController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('jadwal', AdminJadwal::class);

    Route::get('jadwal-grid', [AdminJadwal::class, 'grid'])->name('jadwal.grid');

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // GURU STATUS
    Route::get('/guru/{id}/nonaktif', [GuruController::class, 'nonaktif'])->name('guru.nonaktif');
    Route::get('/guru/{id}/aktifkan', [GuruController::class, 'aktifkan'])->name('guru.aktifkan');

    // SISWA STATUS
    Route::get('/siswa/{id}/nonaktif', [SiswaController::class, 'nonaktif'])->name('siswa.nonaktif');
    Route::get('/siswa/{id}/aktifkan', [SiswaController::class, 'aktifkan'])->name('siswa.aktifkan');

    // 🔥 BULK (INI YANG KAMU BUTUHKAN)
    Route::post('/siswa/bulk/nonaktif', [SiswaController::class, 'bulkNonaktif'])
    ->name('siswa.bulkNonaktif');
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('forgot.password');

Route::post('/forgot-password', [AuthController::class, 'sendOtp']);

Route::get('/verify-otp', function () {
    return view('auth.verify-otp');
})->name('verify.otp');

Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

Route::get('/reset-password', function () {
    return view('auth.reset-password');
})->name('reset.password.form');

Route::post('/reset-password', [AuthController::class, 'resetPasswordOtp']);
});

/*
|--------------------------------------------------------------------------
| GURU
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Guru\DashboardController as GuruDashboard;
use App\Http\Controllers\Guru\JadwalController as GuruJadwal;
use App\Http\Controllers\Guru\AbsensiController as GuruAbsensi;
use App\Http\Controllers\Guru\NilaiController as GuruNilai;

Route::middleware(['auth', 'force.password'])->prefix('guru')->name('guru.')->group(function () {

    Route::get('/dashboard', [GuruDashboard::class, 'index'])->name('dashboard');

    Route::get('/jadwal', [GuruJadwal::class, 'index'])->name('jadwal');

    Route::get('/absensi', [GuruAbsensi::class, 'index'])->name('absensi');

    // ================= NILAI =================

    Route::get('/nilai', [GuruNilai::class, 'index'])->name('nilai.index');

    Route::get('nilai/input', [GuruNilai::class, 'inputNilai'])->name('nilai.input');

    // 🔥 PERBAIKAN: kasih name route
    Route::get('/get-siswa/{id}', [GuruNilai::class, 'getSiswaByKelas'])->name('get.siswa');

    Route::post('/nilai/store-batch', [GuruNilai::class, 'storeBatch'])->name('nilai.storeBatch');
    Route::get('/nilai/{id}/edit', [GuruNilai::class, 'edit'])->name('nilai.edit');
Route::put('/nilai/{id}', [GuruNilai::class, 'update'])->name('nilai.update');
});


/*
|--------------------------------------------------------------------------
| SISWA
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;
use App\Http\Controllers\Siswa\JadwalController as SiswaJadwal;
use App\Http\Controllers\Siswa\AbsensiController as SiswaAbsensi;
use App\Http\Controllers\Siswa\NilaiController as SiswaNilai;
use App\Http\Controllers\Siswa\ProfileController as SiswaProfile;

Route::middleware(['auth', 'force.password'])->prefix('siswa')->name('siswa.')->group(function () {

    Route::get('/dashboard', [SiswaDashboard::class, 'index'])->name('dashboard');

    Route::get('/jadwal', [SiswaJadwal::class, 'index'])->name('jadwal');

    Route::get('/absensi', [SiswaAbsensi::class, 'index'])->name('absensi');

    Route::get('/nilai', [SiswaNilai::class, 'index'])->name('nilai');

    // PROFILE
    Route::get('/profile', [SiswaProfile::class, 'index'])->name('profile');
    Route::post('/profile', [SiswaProfile::class, 'update'])->name('profile.update');
});