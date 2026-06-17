<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// 🔥 IMPORT MODEL
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\MataPelajaran;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mass assignable
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'guru_id',
        'siswa_id',
        'mapel_id',
        'photo',
        'otp',
        'otp_expired_at',
        'telepon',
        'is_default_password',
        'trusted_devices',  // ← tambahkan ini
    ];

    /**
     * Hidden data
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'trusted_devices' => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | 🔥 HELPER ROLE
    |-------------------------------------------------------------------------- 
    */

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isGuru()
    {
        return $this->role === 'guru';
    }

    public function isSiswa()
    {
        return $this->role === 'siswa';
    }

    /*
    |--------------------------------------------------------------------------
    | 🔥 RELASI
    |-------------------------------------------------------------------------- 
    */

    // ✅ USER -> GURU
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    // ✅ USER -> SISWA
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    // ✅ USER -> MAPEL
    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class, 'mapel_id');
    }



    /*
    |--------------------------------------------------------------------------
    | 🔥 HELPER TAMBAHAN (OPSIONAL TAPI BAGUS)
    |-------------------------------------------------------------------------- 
    */

    // Ambil nomor WA dengan fallback
    public function getTeleponLengkap()
    {
        if ($this->telepon) {
            return $this->telepon;
        }

        if ($this->guru && $this->guru->telepon) {
            return $this->guru->telepon;
        }

        // 🔥 fallback tambahan (opsional tapi aman)
        if ($this->siswa && $this->siswa->telepon) {
            return $this->siswa->telepon;
        }

        return null;
    }
}