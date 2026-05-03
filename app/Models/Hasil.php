<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    protected $fillable = ['user_id','ujian_id','nilai'];

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }
}
