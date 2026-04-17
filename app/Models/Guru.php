<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'gurus'; // nama tabel
   protected $fillable = ['nama', 'nip', 'mapel','alamat','telepon','status'];
    public function user()
{
    return $this->hasOne(User::class, 'guru_id');
}

public function jadwal()
{
    return $this->hasMany(\App\Models\Jadwal::class);
}
}

