<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OtpService
{
   public function send(User $user)
{
    $otp = rand(100000, 999999);

    // simpan OTP
    $user->update([
        'otp' => $otp,
        'otp_expired_at' => now()->addMinutes(5)
    ]);

    // ================= EMAIL =================
    \Mail::raw("Kode OTP kamu: $otp", function ($msg) use ($user) {
        $msg->to($user->email)
            ->subject('Kode OTP Login');
    });

    // ================= AMBIL TELEPON =================
    $telepon = null;

    if ($user->siswa && $user->siswa->telepon) {
        $telepon = $user->siswa->telepon;
    } elseif ($user->guru && $user->guru->telepon) {
        $telepon = $user->guru->telepon;
    } elseif ($user->telepon) {
        $telepon = $user->telepon;
    }

    // ================= KIRIM WA =================
    if ($telepon) {
        $this->sendWA($telepon, $otp);
    } else {
        \Log::error('NO HP TIDAK ADA UNTUK USER', [
            'user_id' => $user->id,
            'role' => $user->role
        ]);
    }
}   

    private function sendWA($no, $otp)
    {
        $no = preg_replace('/[^0-9]/', '', $no);

        if (substr($no, 0, 1) === '0') {
            $no = '62' . substr($no, 1);
        }

        $token = env('FONNTE_TOKEN');

        $response = Http::asForm()->withHeaders([
            'Authorization' => $token
        ])->post('https://api.fonnte.com/send', [
            'target' => $no,
            'message' => "Kode OTP kamu: $otp"
        ]);

        Log::info('WA RESULT', [
            'nomor' => $no,
            'response' => $response->json()
        ]);
    }
}