<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PesertaKonfirmasi;

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
        $data_tryout = DB::table('tryout')->get()->all();
        return view('home', [
            'data_tryout' => $data_tryout
        ]);
    }

    public function daftar($id) {
        $data_tryout = DB::table('tryout')->find($id);
        return view('to/daftar-to',[
            'data_tryout' =>$data_tryout
        ]);
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

        $peserta_konfirmasi = PesertaKonfirmasi::create($data_peserta_konfirmasi);
    
        return redirect('daftar-to/'. $peserta_konfirmasi->id_tryout . '/' . $peserta_konfirmasi->id . '/transaksi');
    }

    public function showTransaksi($id_to, $id_peserta) {
        $data_peserta = DB::table('peserta_konfirmasi')
            ->where('peserta_konfirmasi.id', $id_peserta)
            ->join('tryout', 'tryout.id', '=', 'peserta_konfirmasi.id_tryout')
            ->join('users', 'users.id', '=', 'peserta_konfirmasi.id_peserta')
            ->select( 'peserta_konfirmasi.*', 'tryout.*', 'users.*', 'peserta_konfirmasi.id as id_peserta_konfirmasi', 'tryout.id as id_tryout', 'users.id as id_user')
            ->get();
        
        // dd($data_peserta);

        return view('to/transaksi-to', [
            'data_peserta' => $data_peserta
        ]);
    }
}
