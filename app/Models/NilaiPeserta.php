<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPeserta extends Model
{
    use HasFactory;

    protected $table = "nilai_peserta";

    protected $fillable = [
        'id_peserta',
        'id_subtes',
        'nilai'
    ];
}
