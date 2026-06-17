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
        \Log::info('=== LOGIN OTP CALLED - OtpController ===');
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
    \Log::info('=== LOGIN OTP CALLED - OtpController ===');

    $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
        'otp'      => 'nullable|digits:6',
    ]);

    $user = User::with(['guru', 'siswa'])->where('email', $request->email)->first();

    if (!$user) {
        return back()->with('error', 'Email tidak ditemukan.');
    }

    if (!\Hash::check($request->password, $user->password)) {
        return back()->with('error', 'Password salah.');
    }

    // ADMIN → langsung login tanpa OTP
    if ($user->role === 'admin') {
        \Auth::login($user);
        $request->session()->regenerate();
        return redirect()->route('admin.dashboard');
    }

    // Cek status nonaktif
    if ($user->role === 'guru' && (!$user->guru || $user->guru->status === 'nonaktif')) {
        return back()->with('error', 'Akun Anda telah dinonaktifkan.');
    }
    if ($user->role === 'siswa' && (!$user->siswa || $user->siswa->status === 'nonaktif')) {
        return back()->with('error', 'Akun Anda telah dinonaktifkan.');
    }

    // ── Cek cookie trusted device ──
    $cookieKey      = 'trusted_device_' . $user->id;
    $cookieValue    = $request->cookie($cookieKey);
    $trustedDevices = $user->trusted_devices ?? [];
    $isDeviceTrusted = $cookieValue && in_array($cookieValue, $trustedDevices);

    \Log::info('=== DEVICE CHECK ===', [
        'user_id'        => $user->id,
        'cookie_key'     => $cookieKey,
        'cookie_value'   => $cookieValue,
        'trusted_list'   => $trustedDevices,
        'is_trusted'     => $isDeviceTrusted,
        'all_cookies'    => array_keys($request->cookies->all()),
    ]);

    // Device BARU → wajib OTP
    if (!$isDeviceTrusted) {

        if (empty($request->otp)) {
            return back()
                ->withInput()
                ->with('error', 'Perangkat baru terdeteksi! Silakan minta OTP terlebih dahulu.')
                ->with('need_otp', true);
        }

        if (!$user->otp) {
            return back()->withInput()
                ->with('error', 'OTP belum diminta.')
                ->with('need_otp', true);
        }

        if ((string)$request->otp !== (string)$user->otp) {
            return back()->withInput()
                ->with('error', 'Kode OTP salah.')
                ->with('need_otp', true);
        }

        if (!$user->otp_expired_at || now()->gt($user->otp_expired_at)) {
            return back()->withInput()
                ->with('error', 'OTP sudah kadaluarsa.')
                ->with('need_otp', true);
        }

        // Generate token unik untuk device ini
        $deviceToken = \Illuminate\Support\Str::random(60);

        // Simpan ke trusted_devices (maks 10)
        $trustedDevices[] = $deviceToken;
        if (count($trustedDevices) > 10) array_shift($trustedDevices);

        $user->update([
            'otp'             => null,
            'otp_expired_at'  => null,
            'trusted_devices' => $trustedDevices,
        ]);

        \Auth::login($user);
        $request->session()->regenerate();

        // Simpan cookie 365 hari
        $cookie = cookie($cookieKey, $deviceToken, 60 * 24 * 365, '/', null, false, true);

        \Log::info('=== DEVICE TRUSTED SAVED ===', [
            'token' => $deviceToken,
            'cookie_key' => $cookieKey,
        ]);

        return match ($user->role) {
            'guru'  => redirect()->route('guru.dashboard')->withCookie($cookie),
            'siswa' => redirect()->route('siswa.dashboard')->withCookie($cookie),
            default => redirect('/')->withCookie($cookie),
        };
    }

    // Device LAMA → langsung login
    \Log::info('=== DEVICE ALREADY TRUSTED - SKIP OTP ===');

    \Auth::login($user);
    $request->session()->regenerate();

    return match ($user->role) {
        'guru'  => redirect()->route('guru.dashboard'),
        'siswa' => redirect()->route('siswa.dashboard'),
        default => redirect('/'),
    };
}
}