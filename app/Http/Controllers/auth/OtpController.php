<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OtpController extends Controller
{
    // ================= KIRIM OTP =================
    public function sendOtp(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan');
        }

        app(\App\Services\OtpService::class)->send($user);

        return back()->with('success', 'OTP berhasil dikirim');
    }

    // ================= LOGIN =================
    public function loginOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'otp' => 'nullable|digits:6'
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'User tidak ditemukan');
        }

        // 🔐 CEK PASSWORD
        if (!\Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password salah');
        }

        // =========================
        // 🔥 KHUSUS GURU & SISWA WAJIB OTP
        // =========================
        if (in_array($user->role, ['guru', 'siswa'])) {

            if (!$request->otp) {
                return back()->with('error', 'OTP wajib diisi');
            }

            if (!$user->otp) {
                return back()->with('error', 'OTP belum diminta');
            }

            if ((string)$request->otp !== (string)$user->otp) {
                return back()->with('error', 'OTP salah');
            }

            if (!$user->otp_expired_at || now()->gt($user->otp_expired_at)) {
                return back()->with('error', 'OTP sudah kadaluarsa');
            }
        }

        // =========================
        // ✅ LOGIN
        // =========================
        \Auth::login($user);

        // 🔥 HAPUS OTP SETELAH DIPAKAI (hanya untuk guru & siswa)
        if (in_array($user->role, ['guru', 'siswa'])) {
            $user->update([
                'otp' => null,
                'otp_expired_at' => null
            ]);
        }

        // =========================
        // 🔁 REDIRECT ROLE
        // =========================
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role == 'guru') {
            return redirect()->route('guru.dashboard');
        }

        if ($user->role == 'siswa') {
            return redirect()->route('siswa.dashboard');
        }

        return redirect('/');
    }
}