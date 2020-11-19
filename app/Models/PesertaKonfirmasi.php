<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    // public function getRekap($id_to = null, $id_subtes = null) {
    //     $data = DB::table('peserta_konfirmasi')
    //         ->where('peserta_konfirmasi.id_tryout', $id_to)
    //         ->where()
    // }
}
