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
    // ================= LOGIN =================
    public function showLogin()
    {
        return view('auth.login');
    }



public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {

        $user = Auth::user();

        // ================= WA =================
        $telepon = $user->getTeleponLengkap();

        if ($telepon) {
            $no = preg_replace('/^0/', '62', $telepon);

            $pesan  = "🔐 LOGIN BERHASIL\n";
            $pesan .= "User: {$user->name}\n";
            $pesan .= "Email: {$user->email}\n";
            $pesan .= "Waktu: " . now();

            Http::asForm()->withHeaders([
                'Authorization' => env('FONNTE_TOKEN')
            ])->post('https://api.fonnte.com/send', [
                'target' => $no,
                'message' => $pesan,
            ]);
        }

        // ================= REDIRECT ROLE =================
        if ($user->role == 'admin') {
            return redirect('/admin');
        } elseif ($user->role == 'guru') {
            return redirect('/guru');
        } else {
            return redirect('/siswa');
        }
    }

    return back()->with('error', 'Email atau password salah');
}
    // ================= UPDATE PASSWORD =================
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        $user = Auth::user();

        // 🔥 UPDATE + FORCE REFRESH USER
        $user->password = Hash::make($request->password);
        $user->is_default_password = false;
        $user->save();

        // 🔥 PENTING: refresh data user (hindari cache lama)
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_default_password' => false // 🔥 register normal
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

    // ================= BONUS: REDIRECT BY ROLE =================
    private function redirectByRole($user)
    {
        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'guru' => redirect()->route('guru.dashboard'),
            'siswa' => redirect()->route('siswa.dashboard'),
            default => redirect('/login'),
        };
    }

    public function verifyOtp(Request $request)
{
    if ($request->otp == session('otp')) {

        return redirect()->route('reset.password.form'); // ✅ INI WAJIB
    }

    return back()->with('error', 'OTP salah');
}

public function resetPasswordOtp(Request $request)
{
    $request->validate([
        'password' => 'required|min:6|confirmed'
    ]);

    $user = User::find(session('otp_user'));

    $user->update([
        'password' => Hash::make($request->password),
        'otp' => null,
        'otp_expired_at' => null,
        'is_default_password' => false
    ]);

    session()->forget('otp_user');

    return redirect('/login')->with('success', 'Password berhasil diubah');
}

public function sendOtp(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email'
    ]);

    $otp = rand(100000, 999999);

    session([
        'otp' => $otp,
        'email' => $request->email
    ]);

    // kirim email (Mailtrap sudah jalan)

    \Mail::raw("Kode OTP kamu adalah: $otp", function ($message) use ($request) {
        $message->to($request->email)
                ->subject('Kode OTP Reset Password');
    });

    return redirect()->route('verify.otp.form');
}

public function showVerifyOtp()
{
    return view('auth.verify-otp');
}

public function showResetPassword()
{
    return view('auth.reset-password');
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

public function sendWhatsapp($nomor, $pesan)
{
    $token = env('rJ5jmNfJ99gJFNdmjmTW');

    // 🔥 NORMALISASI NOMOR (ANTI SALAH FORMAT)
    $nomor = preg_replace('/[^0-9]/', '', $nomor);

    if (substr($nomor, 0, 1) == '0') {
        $nomor = '62' . substr($nomor, 1);
    }

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.fonnte.com/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => [
            'target' => $nomor,
            'message' => $pesan,
            'countryCode' => '62'
        ],
        CURLOPT_HTTPHEADER => [
            "Authorization: $token"
        ],
    ));

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        dd("CURL ERROR: " . curl_error($curl));
    }

    curl_close($curl);

    // 🔥 DEBUG WAJIB
    return $response;
}
}