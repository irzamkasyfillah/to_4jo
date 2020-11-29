<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PesertaKonfirmasi;
use DateTime;
use DateTimeZone;

use function GuzzleHttp\json_encode;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $now = new DateTime();
        $now->setTimezone(new DateTimeZone('GMT+8'));

        $data_tryout = DB::table('tryout')
            ->where('waktu_selesai', '>', $now)
            ->where('waktu', '<', $now)
            ->get();

        $jml_peserta = [];
        foreach ($data_tryout as $data) {
            $peserta = DB::table('peserta_konfirmasi')
                ->where('id_tryout', $data->id)
                ->get();
            array_push($jml_peserta, count($peserta));
        }
        
        return view('home', [
            'data_tryout' => $data_tryout,
            'jml_peserta' => $jml_peserta
        ]);
    }

    public function daftar($id_to, $id_user) {
        $data_tryout = DB::table('tryout')->find($id_to);
        $check_peserta = DB::table('peserta_konfirmasi')
            ->where('id_tryout', $id_to)
            ->where('id_peserta', $id_user)
            ->get();
        // dd($check_peserta[0]->id);

        if ($check_peserta->count() > 0) {
            return redirect('/transaksi/'.$check_peserta[0]->id);
        } else {
            return view('to/daftar-to',[
                'data_tryout' =>$data_tryout
            ]);
        }
    }

    public function transaksi(Request $request, $id_to, $id_user) {
        $data_tryout = DB::table('tryout')->find($id_to);
        $data_user = DB::table('users')->find($id_user);

        $data_peserta_konfirmasi = [
            'id_peserta' => $data_user->id,
            'id_tryout' => $data_tryout->id,
            'harga' => $request->harga,
            'kelompok_ujian' => $request->kelompok_ujian,
            'status' => "Menunggu Pembayaran",
        ];
        
        $check_peserta = DB::table('peserta_konfirmasi')
        ->where('id_tryout', $id_to)
        ->where('id_peserta', $id_user)
        ->get();
        

        if ($check_peserta->count() > 0) {
            return redirect('/transaksi/'.$check_peserta[0]->id);
        } else {
            $peserta_konfirmasi = PesertaKonfirmasi::create($data_peserta_konfirmasi);
            return redirect('/transaksi/'.$peserta_konfirmasi->id);
        }
    }

    public function showTransaksi($id_transaksi) {
        $data_peserta = DB::table('peserta_konfirmasi')
            ->where('peserta_konfirmasi.id', $id_transaksi)
            ->join('tryout', 'tryout.id', '=', 'peserta_konfirmasi.id_tryout')
            ->join('users', 'users.id', '=', 'peserta_konfirmasi.id_peserta')
            ->select( 'peserta_konfirmasi.*', 'tryout.*','users.*', 'peserta_konfirmasi.id as id_peserta_konfirmasi', 'tryout.id as id_tryout', 'users.id as id_user'
            ,'peserta_konfirmasi.waktu_selesai as waktu_selesai_peserta')
            ->get();

        // dd($data_peserta);

        return view('to/transaksi-to', [
            'data_peserta' => $data_peserta
        ]);
    }

    public function deleteTransaksi($id) {
        $data_peserta = PesertaKonfirmasi::find($id);
        $data_peserta->delete();

        return redirect('/home');
    }

    public function getJumlahUser()
    {
        $data_user = DB::table('users')
            ->where('level', '<>', 'admin')
            ->get();
        
        echo json_encode($data_user);
    }
}
