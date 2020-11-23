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
        'kode_unik',
        'waktu_mulai',
        'waktu_selesai'
    ];

    protected $casts =  [
        'subtes_done' => 'array'
    ];

    public function getRekapPeserta($id_to, $id_subtes= null, $klp = null) {
        $coba = DB::table('peserta_konfirmasi');
        $coba->where('id_tryout', $id_to);
        $coba->where('status', 'Telah Ujian');
        if ($klp != null) {
            $coba->where('kelompok_ujian', $klp);
        }
        $coba->join('users', 'users.id', '=', 'peserta_konfirmasi.id_peserta');
        $coba->select('peserta_konfirmasi.*', 'users.name',
            DB::raw("(select count(jawaban_peserta.id)
            from jawaban_peserta 
            join jawaban on jawaban.id = jawaban_peserta.id_jawaban
            left join soal on soal.id = jawaban_peserta.id_soal
            where jawaban.value = 1 and jawaban_peserta.id_peserta = peserta_konfirmasi.id
            and soal.subtes = $id_subtes
            ) as benar"
            ),
            DB::raw("(select count(jawaban_peserta.id)
                from jawaban_peserta 
                join jawaban on jawaban.id = jawaban_peserta.id_jawaban
                left join soal on soal.id = jawaban_peserta.id_soal
                where jawaban.value = 0 and jawaban_peserta.id_peserta = peserta_konfirmasi.id
                and soal.subtes = $id_subtes
                ) as salah"
            ),
            DB::raw("(select count(jawaban_peserta.id)
                from jawaban_peserta 
                left join soal on soal.id = jawaban_peserta.id_soal
                where jawaban_peserta.id_jawaban = 0 and jawaban_peserta.id_peserta = peserta_konfirmasi.id
                and soal.subtes = $id_subtes
                ) as kosong"
            ),
            DB::raw("(select nilai_peserta.nilai
                from nilai_peserta 
                where nilai_peserta.id_peserta = peserta_konfirmasi.id
                and nilai_peserta.id_subtes =$id_subtes
                ) as nilai"
            )
        );
        $coba->orderBy('peserta_konfirmasi.id');
        return $coba->get();
    }
}
