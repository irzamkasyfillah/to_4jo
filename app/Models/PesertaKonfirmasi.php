<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaKonfirmasi extends Model
{
    use HasFactory;

    protected $table = "peserta_konfirmasi";

    protected $fillable = [
        'id_peserta',
        'id_tryout',
        'harga',
        'status',
        'subtes_done',
        'kelompok_ujian',
        'kode_unik'
    ];

    protected $casts =  [
        'subtes_done' => 'array'
    ];
}
