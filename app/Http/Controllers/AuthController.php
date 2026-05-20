<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Mail\LoginNotification;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    // ================= SHOW LOGIN =================
    public function showLogin()
    {
        return view('auth.login');
    }

    // ================= LOGIN BIASA (email + password) =================
   public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    $user = \App\Models\User::with('guru')
        ->where('email', $request->email)
        ->first();

    if (!$user) {
        return back()->with('error', 'Email tidak ditemukan');
    }

    if (!$user->guru || $user->guru->status !== 'aktif') {
        return back()->with('error', 'Akun anda telah dinonaktifkan');
    }

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();

        // Notifikasi login pertama → HANYA kirim email, tidak WA
        // Hilangkan logika WA di sini agar tidak mengganggu flow OTP
        if ($user->is_default_password) {
            Mail::to($user->email)->send(new \App\Mail\LoginNotification($user));
        }

        return $this->redirectByRole($user);
    }

    return back()->with('error', 'Email atau password salah');
}

    // ================= KIRIM OTP =================
    // Dipanggil dari form Langkah 1 di halaman login
 public function sendOtp(Request $request)
    {
        $method = $request->input('method', 'email'); // 'email' atau 'wa'

        if ($method === 'email') {
            $request->validate([
                'email' => 'required|email|exists:users,email',
            ]);

            // ✅ FIX: tambah with('guru') agar relasi ter-load
            $user = User::with('guru')->where('email', $request->email)->first();

        } else {
            $request->validate([
                'telepon' => 'required|string',
            ]);

            $no = preg_replace('/[^0-9]/', '', $request->telepon);
            if (str_starts_with($no, '0')) {
                $no = '62' . substr($no, 1);
            }

            // ✅ FIX: tambah with('guru') agar relasi ter-load
            $user = User::with('guru')->whereHas('guru', function ($q) use ($no) {
                $q->whereRaw("REGEXP_REPLACE(telepon, '[^0-9]', '') LIKE ?", ["%{$no}%"]);
            })->orWhereHas('siswa', function ($q) use ($no) {
                $q->whereRaw("REGEXP_REPLACE(telepon, '[^0-9]', '') LIKE ?", ["%{$no}%"]);
            })->first();

            if (!$user) {
                return back()->with('error', 'Nomor WhatsApp tidak ditemukan.');
            }
        }

        // ✅ FIX: blokir pengiriman OTP untuk guru nonaktif
        if ($user->role === 'guru' && $user->guru && $user->guru->status === 'nonaktif') {
            return back()->with('error', 'Akun Anda telah dinonaktifkan. Hubungi administrator.');
        }

        // Kirim OTP sesuai method — email SAJA atau WA SAJA
        app(\App\Services\OtpService::class)->send($user, $method);

        // Simpan email ke session untuk prefill form login
        session(['email' => $user->email]);

        return back()->with('otp_sent', 'OTP berhasil dikirim!');
    }


    // ================= LOGIN DENGAN OTP (Langkah 2) =================
    // Dipanggil dari form Langkah 2 di halaman login
 public function loginOtp(Request $request)
{
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
        'otp'      => 'nullable|digits:6',
    ]);

    // ✅ FIX: tambah with('guru') agar relasi ter-load
    $user = User::with('guru')->where('email', $request->email)->first();

    if (!$user) {
        return back()->with('error', 'Email tidak ditemukan.');
    }

    // Cek password
    if (!Hash::check($request->password, $user->password)) {
        return back()->with('error', 'Password salah.');
    }

    // =================================================
    // ADMIN → LANGSUNG LOGIN TANPA OTP
    // =================================================
    if ($user->role === 'admin') {

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    // =================================================
    // GURU / SISWA WAJIB OTP
    // =================================================
    if (in_array($user->role, ['guru', 'siswa'])) {

        // ✅ FIX: cek status nonaktif sebelum proses OTP
        if ($user->role === 'guru') {
            $user->load('guru'); // reload fresh dari DB
            if (!$user->guru || $user->guru->status === 'nonaktif') {
                return back()->with('error', 'Akun Anda telah dinonaktifkan. Hubungi administrator.');
            }
        }

        if (empty($request->otp)) {
            return back()->with('error', 'OTP wajib diisi.');
        }

        if (!$user->otp) {
            return back()->with('error', 'OTP belum diminta.');
        }

        if ((string)$request->otp !== (string)$user->otp) {
            return back()->with('error', 'Kode OTP salah.');
        }

        if (!$user->otp_expired_at || now()->gt($user->otp_expired_at)) {
            return back()->with('error', 'OTP sudah kadaluarsa.');
        }

        // Login
        Auth::login($user);
        $request->session()->regenerate();

        // Hapus OTP
        $user->update([
            'otp' => null,
            'otp_expired_at' => null,
        ]);

        return match ($user->role) {
            'guru'  => redirect()->route('guru.dashboard'),
            'siswa' => redirect()->route('siswa.dashboard'),
            default => redirect('/'),
        };
    }

    return back()->with('error', 'Role tidak dikenali.');
}


    // ================= UPDATE PASSWORD =================
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        $user = Auth::user();

        $user->password = Hash::make($request->password);
        $user->is_default_password = false;
        $user->save();

        Auth::setUser($user->fresh());

        return $this->redirectByRole($user);
    }

    // ================= REGISTER =================
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role'     => 'required'
        ]);

        User::create([
            'name'               => $request->name,
            'email'              => $request->email,
            'password'           => Hash::make($request->password),
            'role'               => $request->role,
            'is_default_password' => false,
        ]);

        return redirect('/login')->with('success', 'Register berhasil');
    }

    // ================= LOGOUT =================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // ================= VERIFY OTP (halaman terpisah jika ada) =================
    public function showVerifyOtp()
    {
        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request)
{
    $request->validate([
        'otp' => 'required|digits:6'
    ]);

    $user = User::where('email', session('email'))->first();

    if (!$user) {
        return back()->with('error', 'User tidak ditemukan');
    }

    // cek OTP
    if ((string)$request->otp !== (string)$user->otp) {
        return back()->with('error', 'OTP salah');
    }

    // cek expired
    if (!$user->otp_expired_at || now()->gt($user->otp_expired_at)) {
        return back()->with('error', 'OTP sudah kadaluarsa');
    }

    // simpan user reset password
    session(['otp_user' => $user->id]);

    return redirect()->route('reset.password.form');
}

    // ================= RESET PASSWORD (via OTP lupa password) =================
    public function showResetPassword()
    {
        return view('auth.reset-password');
    }

    public function resetPasswordOtp(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::find(session('otp_user'));

        $user->update([
            'password'           => Hash::make($request->password),
            'otp'                => null,
            'otp_expired_at'     => null,
            'is_default_password' => false,
        ]);

        session()->forget('otp_user');

        return redirect('/login')->with('success', 'Password berhasil diubah');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6'
        ]);

        $user = \App\Models\User::where('email', session('email'))->first();

        if (!$user) {
            return back()->with('error', 'User tidak ditemukan');
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Password berhasil diubah');
    }

    // ================= HELPER: REDIRECT BY ROLE =================
   private function redirectByRole($user)
    {
        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'guru'  => redirect()->route('guru.dashboard'),
            'siswa' => redirect()->route('siswa.dashboard'),
            default => redirect('/login'),
        };
    }

        // ================= FORGOT PASSWORD OTP =================
    public function sendForgotPasswordOtp(Request $request)
{
    $request->validate([
        'email' => 'required|email'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->with('error', 'Email tidak ditemukan');
    }

    $otp = rand(100000, 999999);

    $user->update([
        'otp' => $otp,
        'otp_expired_at' => now()->addMinutes(5),
    ]);

    Mail::raw("Kode OTP reset password Anda adalah: $otp", function ($message) use ($user) {
        $message->to($user->email)
                ->subject('OTP Reset Password');
    });

    session([
        'email' => $user->email
    ]);

    return redirect()->route('verify.otp.form')
        ->with('success', 'OTP reset password berhasil dikirim');
}
}