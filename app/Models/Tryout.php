<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tryout extends Model
{
    use HasFactory;

    protected $table = "tryout";

    protected $fillable = [
        'nama',
        'harga',
        'soal',
        'waktu',
        'waktu_selesai'
    ];

    protected $casts =  [
        'soal' => 'array'
    ];
}
