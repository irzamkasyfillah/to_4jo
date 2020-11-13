<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

use App\Models\Notifikasi;

class NotifikasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id)
    {
        $data = DB::table('notifikasi')
            ->where('id_user', $id)
            ->orderBy('created_at', 'desc')
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
            ->join('users','users.id','=','notifikasi.id_user' )
            ->join('tryout','tryout.id','=','peserta_konfirmasi.id_tryout')
            ->select('peserta_konfirmasi.kelompok_ujian', 'notifikasi.*','tryout.nama', 'tryout.waktu', 'users.name', 'notifikasi.id as id_notif', 'peserta_konfirmasi.id as id_peserta_konfirm', 'users.id as id_users', 'tryout.id as id_tryout')
            ->get();
        
        // $data[0]->isi= Crypt::decryptString($data[0]->isi);
        // dd($data);
        return view('detail-notifikasi', [
            'data' => $data
        ]);
    }

    public function getJumlahNotif($id) {
        $data = DB::table('notifikasi')
            ->where('notifikasi.id_user', $id)
            ->where('read', false)
            ->get();

        // $data->count();
        echo ($data->count());
    }
}
