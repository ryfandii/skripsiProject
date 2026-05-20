<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class OtpController extends Controller
{
    // ================= KIRIM OTP =================
    public function sendOtp(Request $request)
    {
        $method = $request->input('method', 'email');

        if ($method === 'email') {
            $request->validate([
                'email' => 'required|email|exists:users,email',
            ]);

            $user = User::with(['guru', 'siswa'])->where('email', $request->email)->first();

        } else {
            $request->validate([
                'telepon' => 'required|string',
            ]);

            $no = preg_replace('/[^0-9]/', '', $request->telepon);
            if (str_starts_with($no, '0')) {
                $no = '62' . substr($no, 1);
            }
            $no08 = '0' . substr($no, 2);

            $user = User::with(['guru', 'siswa'])->whereHas('guru', function ($q) use ($no, $no08) {
                $q->where('telepon', $no)
                  ->orWhere('telepon', $no08)
                  ->orWhere('telepon', 'like', '%' . substr($no, -9) . '%');
            })->orWhereHas('siswa', function ($q) use ($no, $no08) {
                $q->where('telepon', $no)
                  ->orWhere('telepon', $no08)
                  ->orWhere('telepon', 'like', '%' . substr($no, -9) . '%');
            })->first();

            if (!$user) {
                return back()->with('error', 'Nomor WhatsApp tidak ditemukan.');
            }
        }

        // ✅ FIX: blokir guru nonaktif
        if ($user->role === 'guru' && $user->guru && $user->guru->status === 'nonaktif') {
            return back()->with('error', 'Akun Anda telah dinonaktifkan. Hubungi administrator.');
        }

        // ✅ FIX BARU: blokir siswa nonaktif
        if ($user->role === 'siswa' && $user->siswa && $user->siswa->status === 'nonaktif') {
            return back()->with('error', 'Akun Anda telah dinonaktifkan. Hubungi administrator.');
        }

        app(\App\Services\OtpService::class)->send($user, $method);

        session(['email' => $user->email]);

      return back()->with('otp_sent', 'OTP berhasil dikirim!');
    }

    // ================= LOGIN DENGAN OTP =================
    public function loginOtp(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
            'otp'      => 'nullable|digits:6',
        ]);

        $user = User::with(['guru', 'siswa'])->where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'User tidak ditemukan');
        }

        if (!\Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password salah');
        }

        // ✅ FIX: cek status nonaktif untuk guru
        if ($user->role === 'guru') {
            $user->load('guru');
            if (!$user->guru || $user->guru->status === 'nonaktif') {
                return back()->with('error', 'Akun Anda telah dinonaktifkan. Hubungi administrator.');
            }
        }

        // ✅ FIX BARU: cek status nonaktif untuk siswa
        if ($user->role === 'siswa') {
            $user->load('siswa');
            if (!$user->siswa || $user->siswa->status === 'nonaktif') {
                return back()->with('error', 'Akun Anda telah dinonaktifkan. Hubungi administrator.');
            }
        }

        // Guru & Siswa wajib OTP
        if (in_array($user->role, ['guru', 'siswa'])) {

            if (!$request->otp) {
                return back()->with('error', 'OTP wajib diisi');
            }

            if (!$user->otp) {
                return back()->with('error', 'OTP belum diminta');
            }

            if ((string) $request->otp !== (string) $user->otp) {
                return back()->with('error', 'OTP salah');
            }

            if (!$user->otp_expired_at || now()->gt($user->otp_expired_at)) {
                return back()->with('error', 'OTP sudah kadaluarsa');
            }
        }

        \Auth::login($user);
        $request->session()->regenerate();

        if (in_array($user->role, ['guru', 'siswa'])) {
            $user->update(['otp' => null, 'otp_expired_at' => null]);
        }

        session()->forget('email');

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'guru'  => redirect()->route('guru.dashboard'),
            'siswa' => redirect()->route('siswa.dashboard'),
            default => redirect('/'),
        };
    }
}