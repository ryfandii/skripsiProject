<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OtpService
{
    /**
     * Kirim OTP ke email SAJA atau WA SAJA, tidak keduanya.
     * $method = 'email' | 'wa'
     */
    public function send(User $user, string $method = 'email')
    {
        $otp = rand(100000, 999999);

        // Simpan OTP ke database
        $user->update([
            'otp'            => $otp,
            'otp_expired_at' => now()->addMinutes(5),
        ]);

        if ($method === 'email') {
            // ── KIRIM KE EMAIL SAJA ──────────────────────
            \Mail::raw(
                "Kode OTP kamu: {$otp}\nBerlaku 5 menit. Jangan bagikan ke siapapun.",
                function ($msg) use ($user) {
                    $msg->to($user->email)->subject('Kode OTP Login');
                }
            );

        } else {
            // ── KIRIM KE WA SAJA ─────────────────────────
            $telepon = null;

            if ($user->siswa && $user->siswa->telepon) {
                $telepon = $user->siswa->telepon;
            } elseif ($user->guru && $user->guru->telepon) {
                $telepon = $user->guru->telepon;
            } elseif ($user->telepon) {
                $telepon = $user->telepon;
            }

            if ($telepon) {
                $this->sendWA($telepon, $otp);
            } else {
                Log::error('NO HP TIDAK ADA UNTUK USER', [
                    'user_id' => $user->id,
                    'role'    => $user->role,
                ]);
            }
        }
    }

    private function sendWA($no, $otp)
    {
        $no = preg_replace('/[^0-9]/', '', $no);

        if (str_starts_with($no, '0')) {
            $no = '62' . substr($no, 1);
        }

        $response = Http::asForm()->withHeaders([
            'Authorization' => env('FONNTE_TOKEN'),
        ])->post('https://api.fonnte.com/send', [
            'target'  => $no,
            'message' => "🔐 Kode OTP kamu: *{$otp}*\nBerlaku 5 menit. Jangan bagikan ke siapapun.",
        ]);

        Log::info('WA RESULT', [
            'nomor'    => $no,
            'response' => $response->json(),
        ]);
    }
}