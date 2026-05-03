<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $fillable = [
        'ujian_id','pertanyaan','a','b','c','d','jawaban_benar'
    ];

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }
}
