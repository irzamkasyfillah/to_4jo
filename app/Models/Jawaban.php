<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;

    protected $table = "jawaban";

    protected $fillable = [
        'id_soal',
        'jawaban_benar',
        'jawaban_salah_1',
        'jawaban_salah_2',
        'jawaban_salah_3',
        'jawaban_salah_4'
    ];
}
