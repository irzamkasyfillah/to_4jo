<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanPeserta extends Model
{
    use HasFactory;
    
    protected $table = "jawaban_peserta";

    protected $fillable = [
        'id_peserta',
        'id_soal',
        'id_jawaban',
        'ragu'
    ];
}
