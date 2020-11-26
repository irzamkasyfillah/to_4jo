<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

use App\Models\Notifikasi;
use App\Models\Subtes;

class NotifikasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id)
    {
        $data = DB::table('peserta_konfirmasi')
            ->where('peserta_konfirmasi.id_peserta', $id)
            ->join('users', 'users.id', '=', 'peserta_konfirmasi.id_peserta')
            ->join('notifikasi', 'notifikasi.id_peserta', '=', 'peserta_konfirmasi.id')
            ->select('peserta_konfirmasi.id_peserta as id_peserta_konfirmasi', 'notifikasi.*', 'notifikasi.id_peserta as id_peserta_notifikasi', 'users.*', 'notifikasi.id as id_notifikasi')
            ->orderBy('notifikasi.created_at', 'desc')
            ->get();

        // dd($data);
        return view('notifikasi', [
            'data' => $data
        ]);
    }

    public function show($id)
    {
        $data = Notifikasi::find($id);
        $data->update(['read' => true]);
        $data = DB::table('notifikasi')
            ->where('notifikasi.id',$id)
            ->join('peserta_konfirmasi','peserta_konfirmasi.id','=','notifikasi.id_peserta')
            ->join('users','users.id','=','peserta_konfirmasi.id_peserta' )
            ->join('tryout','tryout.id','=','peserta_konfirmasi.id_tryout')
            ->select('peserta_konfirmasi.kelompok_ujian', 'notifikasi.*','tryout.nama', 'tryout.waktu', 'users.name', 'notifikasi.id as id_notif', 'peserta_konfirmasi.id as id_peserta_konfirm', 'users.id as id_users', 'tryout.id as id_tryout')
            ->get();
        
        $nilai_peserta = DB::table('nilai_peserta')
            ->where('nilai_peserta.id_peserta', $data[0]->id_peserta_konfirm)
            ->join('subtes', 'subtes.id', '=', 'nilai_peserta.id_subtes')
            ->select('subtes.nama', 'nilai_peserta.*')
            ->get();
        
        $data_subtes = Subtes::all();
        return view('detail-notifikasi', [
            'data' => $data,
            'nilai_peserta' => $nilai_peserta,
            'data_subtes' => $data_subtes
        ]);
    }

    public function getJumlahNotif($id) {
        $data = DB::table('peserta_konfirmasi')
            ->where('peserta_konfirmasi.id_peserta', $id)
            ->join('notifikasi', 'notifikasi.id_peserta', '=', 'peserta_konfirmasi.id')
            ->where('notifikasi.read', false)
            ->get();

        // $data->count();
        echo ($data->count());
    }
}
