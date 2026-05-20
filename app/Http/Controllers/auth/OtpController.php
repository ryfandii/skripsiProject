<?php

namespace app\Http\Controllers\Auth;

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
            // ── EMAIL ──
            $request->validate([
                'email' => 'required|email|exists:users,email',
            ]);

            $user = User::where('email', $request->email)->first();

        } else {
            // ── WHATSAPP ──
            $request->validate([
                'telepon' => 'required|string',
            ]);

            $no = preg_replace('/[^0-9]/', '', $request->telepon);
            if (str_starts_with($no, '0')) {
                $no = '62' . substr($no, 1);
            }
            $no08 = '0' . substr($no, 2);

            $user = User::whereHas('guru', function ($q) use ($no, $no08) {
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

        // Kirim OTP sesuai method (email SAJA atau WA SAJA)
        app(\App\Services\OtpService::class)->send($user, $method);

        // Simpan email ke session untuk prefill form login
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

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'User tidak ditemukan');
        }

        if (!\Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password salah');
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

        // Hapus OTP setelah dipakai
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