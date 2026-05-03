<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{ protected $fillable = ['judul','durasi','mulai','selesai','guru_id'];

    public function soals()
    {
        return $this->hasMany(Soal::class);
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }
}
