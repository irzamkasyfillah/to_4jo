<?php

namespace App\Http\Controllers;

use App\Models\JawabanPeserta;
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
    
    public function showSoal($id_to, $id_subtes, $no)
    {
        $data_tryout = DB::table('tryout')
            ->where('tryout.id', $id_to)
            ->get();

        $data_soal = DB::table('soal')
            ->where('soal.subtes', $id_subtes)
            ->join('subtes', 'subtes.id', '=', 'soal.subtes')
            ->select('soal.*', 'soal.id as id_soal', 'subtes.nama')
            ->get();
        
        $data_jawaban = DB::table('jawaban')
            ->where('id_soal', $data_soal[$no-1]->id)
            ->inRandomOrder()
            ->get();

        $data_jawaban_peserta = DB::table('jawaban_peserta')
            ->where('jawaban_peserta.id_peserta', session()->get('loginTO')['id'])
            ->where('jawaban_peserta.id_soal', $data_soal[$no-1]->id)
            ->get();

        $data_semua_jawaban_peserta = DB::table('jawaban_peserta')
            ->where('jawaban_peserta.id_peserta', session()->get('loginTO')['id'])
            ->select('id_soal')
            ->get();

        $array_jawaban = [];
        foreach ($data_semua_jawaban_peserta as $data) {
            array_push($array_jawaban, $data->id_soal);
        }

        $data_semua_jawaban_peserta_ragu = DB::table('jawaban_peserta')
            ->where('jawaban_peserta.id_peserta', session()->get('loginTO')['id'])
            ->where('ragu', 1)
            ->select('id_soal')
            ->get();

        $array_jawaban_ragu = [];
        foreach ($data_semua_jawaban_peserta_ragu as $data) {
            array_push($array_jawaban_ragu, $data->id_soal);
        }

        // dd($data_tryout, $data_soal, $data_jawaban, $data_jawaban_peserta, $data_semua_jawaban_peserta);
        return view('to/kerja-to', [
            'data_tryout' => $data_tryout,
            'data_soal' => $data_soal,
            'no' => $no,
            'data_jawaban' => $data_jawaban,
            'data_jawaban_peserta' => $data_jawaban_peserta,
            'array_jawaban' => $array_jawaban,
            'array_jawaban_ragu' => $array_jawaban_ragu
            ]);
    }
    
    public function showKonfirmasiPeserta()
    {
        $data_peserta_konfirmasi = DB::table('peserta_konfirmasi')
        ->where('status', 'Menunggu Pembayaran')
        ->join('users', 'users.id', '=', 'peserta_konfirmasi.id_peserta')
        ->join('tryout', 'tryout.id', '=', 'peserta_konfirmasi.id_tryout')
        ->select('peserta_konfirmasi.*', 'users.*', 'tryout.nama', 'users.id as id_user', 'tryout.id as id_tryout', 'peserta_konfirmasi.id as id_peserta_konfirmasi')
        ->get();
        
        // dd($data_peserta_konfirmasi);
        return view('admin/setting-try-out/peserta-konfirmasi', [
            'data_peserta_konfirmasi' => $data_peserta_konfirmasi
        ]);
    }
    
    
    public function terimaPeserta($id) {
        function generate_string($input, $strength = 16) {
            $input_length = strlen($input);
            $random_string = '';
            for($i = 0; $i < $strength; $i++) {
                $random_character = $input[mt_rand(0, $input_length - 1)];
                $random_string .= $random_character;
            }
            return $random_string;
        }
        $data_peserta = PesertaKonfirmasi::find($id);
        
        $permitted_chars = '!@#$%^&*()_+-=01234567890123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        
        ulang:
        $kode = generate_string($permitted_chars, 12);
        $diterima = [
            'status' => 'Diterima',
            'kode_unik' => $kode
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
                'isi' => $kode,
                'read' => false
            ];
            
            if (!$validate->fails()) {
                $data_peserta->update($diterima);
                Notifikasi::create($notif);
                return redirect('tryout/konfirmasi-peserta')->with('success', 'Data peserta telah diterima.');
            } else {
                goto ulang;
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

    public function showLogin(Request $request, $id_to) {
        if ($request->session()->has('loginTO')) {
            if ($request->session()->get('loginTO')['id_to'] == $id_to) {
                $data = Tryout::find($id_to);
                return redirect(route('tryout.index', $id_to));
            } 
        } 

        $data = Tryout::find($id_to);
        // dd($data);
        return view('to/kode-unik', [
            'data' => $data
        ]);
    }

    public function login(Request $request, $id_to, $id) {
        $check_kode = DB::table('peserta_konfirmasi')
        ->where('id_peserta', $id)
        ->where('id_tryout', $id_to)
        ->get();
        
        if ($check_kode->count() > 0) {
            if ($check_kode[0]->kode_unik == $request->kode_unik ) {
                $request->session()->put('loginTO', [
                    'id' => $id,
                    'id_to' => $id_to ]);
                return redirect(route('tryout.index', $id_to));
            } else {
                return redirect()->back()->with('failed', 'Kode yang anda masukkan salah');    
            }
        } else {
            return redirect()->back()->with('failed', 'Anda belum terdaftar sebagai peserta try out ini.');
        }
    }

    public function listTO(Request $request, $id_to)
    {
        if ($request->session()->has('loginTO')) {
            if ($request->session()->get('loginTO')['id_to'] == $id_to) {
                $data = DB::table('peserta_konfirmasi')
                    ->where('id_peserta', $request->session()->get('loginTO')['id'])
                    ->where('id_tryout', $id_to)
                    ->join('tryout', 'tryout.id', '=', 'peserta_konfirmasi.id_tryout')
                    ->select('tryout.*', 'peserta_konfirmasi.*', 'tryout.id as id_tryout', 'peserta_konfirmasi.id as id_peserta_konfirmasi')
                    ->get();

                // dd($data);
                return view('to/list-to', [
                    'data' => $data
                ]);
            } else {
                return redirect(route('tryout.showlogin', $id_to));    
            }
        } else {
            return redirect(route('tryout.showlogin', $id_to));
        }
    }

    public function insertJawabanPeserta($id_peserta, $id_soal, $id_jawaban) {
        $check_answered = DB::table('jawaban_peserta')
            ->where('jawaban_peserta.id_soal', $id_soal)
            ->get();

        $data_input = [
            'id_peserta' => $id_peserta,
            'id_soal' => $id_soal,
            'id_jawaban' => $id_jawaban,
            'ragu' => 0
        ];
        
        if (count($check_answered) > 0) {
            $jawaban = JawabanPeserta::find($check_answered[0]->id);
            $jawaban->update($data_input);
            // echo 'berhasil update';
        } else {
            JawabanPeserta::create($data_input);
            // echo 'berhasil create';
        }

    }

    public function insertRagu($id_peserta, $id_soal, $ragu) {
        $check_answered = DB::table('jawaban_peserta')
            ->where('jawaban_peserta.id_soal', $id_soal)
            ->get();

        $data_input = [
            'id_peserta' => $id_peserta,
            'id_soal' => $id_soal,
            'ragu' => $ragu
        ];
        
        if (count($check_answered) > 0) {
            $jawaban = JawabanPeserta::find($check_answered[0]->id);
            $jawaban->update($data_input);
            // echo 'berhasil update ragu'. $ragu;
        } else {
            JawabanPeserta::create($data_input);
            // echo 'berhasil create ragu'. $ragu;
        }

    }
}
