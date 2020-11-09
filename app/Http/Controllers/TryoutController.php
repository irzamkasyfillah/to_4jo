<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Models\PesertaKonfirmasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

use App\Models\Tryout;
use App\Models\Soal;

class TryoutController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_tryout = Tryout::all();
        $data_subtes = DB::table('subtes')->get()->all();
        $data_soal = DB::table('soal')->get()->all();

        // dd($data_tryout[0]->soal);
        
        return view('admin/setting-try-out/index', [
            'data_tryout' => $data_tryout,
            'data_subtes' => $data_subtes,
            'data_soal' => $data_soal
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    

    public function create()
    {   
        $data_subtes = DB::table('subtes')->get()->all();
        $data_soal = DB::table('soal')->get()->all();

        return view('admin/setting-try-out/create', [
            'data_subtes' => $data_subtes,
            'data_soal' => $data_soal
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'harga' => ['required', 'integer'],
            'soal' => ['nullable', 'array']
        ]);

        // $request->waktu = date_format(date_create($request->waktu), 'Y-m-d H:i:s');

        Tryout::create($request->all());

        return redirect(route('data-tryout.index'))->with('success', 'Data Berhasil Ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $data_tryout = Tryout::find($id);
        $data_subtes = DB::table('subtes')->get()->all();
        $data_soal = DB::table('soal')->get()->all();
        
        // dd($data_tryout);
        return view('admin/setting-try-out/edit', [
            'data_tryout' => $data_tryout,
            'data_subtes' => $data_subtes,
            'data_soal' => $data_soal
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'harga' => ['required', 'integer'],
            'soal' => ['nullable', 'array']
        ]);

        $tryout = Tryout::find($id);
        $tryout->update($request->all());

        return redirect(route('data-tryout.index'))->with('success', 'Data Berhasil Di-update.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tryout = Tryout::find($id);
        $tryout->delete();

        return redirect(route('data-tryout.index'))->with('success', 'Data Berhasil Dihapus.');
    }

    // UNTUK PESERTA TRY OUT
    public function listTO()
    {
        return view('to/list-to');
    }

    public function showSoal($subtes, $id)
    {
        return view('to/kerja-to', ['subtes' => $subtes,
                                    'id' => $id]); 
    }

    public function showKonfirmasiPeserta()
    {
        $data_peserta_konfirmasi = DB::table('peserta_konfirmasi')
            ->where('status', 'Menunggu Pembayaran')
            ->join('users', 'users.id', '=', 'peserta_konfirmasi.id_peserta')
            ->join('tryout', 'tryout.id', '=', 'peserta_konfirmasi.id_tryout')
            ->select('peserta_konfirmasi.*', 'users.*', 'tryout.*', 'users.id as id_user', 'tryout.id as id_tryout', 'peserta_konfirmasi.id as id_peserta_konfirmasi')
            ->get();
            
        // dd($data_peserta_konfirmasi);
        return view('admin/setting-try-out/peserta-konfirmasi', [
            'data_peserta_konfirmasi' => $data_peserta_konfirmasi
        ]);
    }

    public function terimaPeserta($id) {
        $data_peserta = PesertaKonfirmasi::find($id);
        
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      
        function generate_string($input, $strength = 16) {
            $input_length = strlen($input);
            $random_string = '';
            for($i = 0; $i < $strength; $i++) {
                $random_character = $input[mt_rand(0, $input_length - 1)];
                $random_string .= $random_character;
            }
            return time().$random_string;
        }

        $kode = substr(generate_string($permitted_chars, 10), 5);
        $diterima = [
            'status' => 'Diterima',
            'kode_unik' => Crypt::encryptString($kode)
        ];
        $validate = Validator::make($diterima, [
            'kode_unik' => ['required', 'string', 'max:255', Rule::unique('peserta_konfirmasi')],
        ]);

        //Kirim notifikasi
        $notif = [
            'pengirim' => 'System',
            'id_user' => $data_peserta->id_peserta,
            'id_peserta' => $data_peserta->id,
            'judul' => 'Kode Unik Peserta Try Out',
            'isi' => Crypt::encryptString($kode)
        ];

        if (!$validate->fails()) {
            $data_peserta->update($diterima);
            Notifikasi::create($notif);
            return redirect('tryout/konfirmasi-peserta')->with('success', 'Data peserta telah diterima.');
        } else {
            return redirect('tryout/konfirmasi-peserta')->with('failed', 'Data peserta gagal diterima. Silakan ulangi beberapa saat lagi.');
        }
    }

    public function tolakPeserta($id) {
        $data_peserta = PesertaKonfirmasi::find($id);
        $ditolak = [
            'status' => 'Ditolak'
        ];
        $data_peserta->update($ditolak);
        return redirect('tryout/konfirmasi-peserta')->with('success', 'Data peserta ditolak.');
    }
}
