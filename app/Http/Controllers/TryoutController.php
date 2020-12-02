<?php

namespace App\Http\Controllers;

use App\Models\JawabanPeserta;
use App\Models\Notifikasi;
use App\Models\PeraturanTO;
use App\Models\PesertaKonfirmasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

use App\Models\Tryout;
use App\Models\Soal;
use App\Models\Subtes;
use DateInterval;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Date;

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
        $now = new DateTime();
        $now->setTimezone(new DateTimeZone('GMT+8'));    
        $data_tryout = DB::table('tryout')
            ->where('waktu_selesai', '>', $now)
            ->get();
        $data_subtes = DB::table('subtes')->get()->all();
        $data_soal = DB::table('soal')->get()->all();

        $jml_peserta = [];
        foreach ($data_tryout as $data) {
            $peserta = DB::table('peserta_konfirmasi')
                ->where('id_tryout', $data->id)
                ->get();
            array_push($jml_peserta, count($peserta));
        }
        // dd($jml_peserta, $data_tryout);

        return view('admin/setting-try-out/index', [
            'data_tryout' => $data_tryout,
            'data_subtes' => $data_subtes,
            'data_soal' => $data_soal,
            'jml_peserta' => $jml_peserta
            ]);
    }

    public function indexSettingWaktu() {
        $data = DB::table('subtes')
            ->get();
        // dd($data);
        return view('admin/setting-try-out/setting/index', [
            'data' => $data
        ]);
    }

    public function editSettingWaktu($id) {
        $data = Subtes::find($id);
        return view('admin/setting-try-out/setting/edit', [
            'data' => $data
        ]);
    }

    public function updateSettingWaktu(Request $request, $id) {
        $request->validate([
            'durasi' => ['integer']
        ]);

        $data = Subtes::find($id);
        $data->update($request->all());
        return redirect(route('setting-waktu-pengerjaan-subtes.index'))->with('success', 'Data berhasil di-update');
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
        $data_tryout = Tryout::find($id);
        $data_subtes = DB::table('subtes')->get()->all();
        $data_soal = DB::table('soal')->get()->all();
        
        return view('admin/setting-try-out/show', [
            'data_tryout' => $data_tryout,
            'data_soal' => $data_soal,
            'data_subtes' => $data_subtes
        ]);
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
            'soal' => ['nullable']
        ]);
        $tryout = Tryout::find($id);
        if ($request->soal == null) {
            $tryout->update([
                'soal' => null
            ]);
        }
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
    
    public function showSoal(Request $request, $id_to, $id_subtes, $no)
    {   
        if ($request->session()->has('loginTO')) {
            if ($request->session()->get('loginTO')['id_to'] == $id_to) {
                goto sudah_login;
            } else {
                return redirect(route('tryout.showlogin', $id_to));    
            }
        } else {
            return redirect(route('tryout.showlogin', $id_to));
        }
        sudah_login :
        $data_peserta = DB::table('peserta_konfirmasi')
            ->where('id_peserta', $request->session()->get('loginTO')['id'])
            ->where('id_tryout', $id_to)
            ->get();

        // dd($id_subtes, session());
        // CEK IF PAKET SOAL SUDAH DIKERJAKAN ATAU BELUM
        $subtes_done = $data_peserta[0]->subtes_done;
        if ($id_subtes < 6) {
            if (strpos($subtes_done, '1') && strpos($subtes_done, '2') && strpos($subtes_done, '3') && strpos($subtes_done, '4') && strpos($subtes_done, '5')) {
                return redirect()->back()->with('failed', 'Maaf, Anda telah mengerjakan kategori soal TPS');
            }
        } else if ($id_subtes < 10) {
            if (strpos($subtes_done, '6') && strpos($subtes_done, '7') && strpos($subtes_done, '8') && strpos($subtes_done, '9')) {
                return redirect()->back()->with('failed', 'Maaf, Anda telah mengerjakan kategori soal TKA SAINTEK');
            }
        } else {
            if (strpos($subtes_done, '10') && strpos($subtes_done, '11') && strpos($subtes_done, '12') && strpos($subtes_done, '13')) {
                return redirect()->back()->with('failed', 'Maaf, Anda telah mengerjakan kategori soal TKA SOSHUM');
            }
        }
        
        // CHECK SUBTES-URL WITH SESSION-SUBTES
        if ($request->session()->has('subtes')) {
            $id_subtes = session()->get('subtes');
            goto sama_subtesnya;
        } else {
            $request->session()->put('subtes', $id_subtes);

            sama_subtesnya:
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
                ->where('jawaban_peserta.id_peserta', session()->get('loginTO')['id_peserta'])
                ->where('jawaban_peserta.id_soal', $data_soal[$no-1]->id)
                ->get();
    
            $data_semua_jawaban_peserta = DB::table('jawaban_peserta')
                ->where('jawaban_peserta.id_peserta', session()->get('loginTO')['id_peserta'])
                ->where('jawaban_peserta.id_jawaban', '<>', 0)
                ->select('id_soal')
                ->get();
    
            $array_jawaban = [];
            foreach ($data_semua_jawaban_peserta as $data) {
                array_push($array_jawaban, $data->id_soal);
            }
    
            $data_semua_jawaban_peserta_ragu = DB::table('jawaban_peserta')
                ->where('jawaban_peserta.id_peserta', session()->get('loginTO')['id_peserta'])
                ->where('ragu', 1)
                ->select('id_soal')
                ->get();
    
            $array_jawaban_ragu = [];
            foreach ($data_semua_jawaban_peserta_ragu as $data) {
                array_push($array_jawaban_ragu, $data->id_soal);
            }

            $peserta_konfirmasi = PesertaKonfirmasi::find(session()->get('loginTO')['id_peserta']);
            $subtes = Subtes::find($id_subtes);
            if ($peserta_konfirmasi->waktu_mulai == null) {
                $now = new DateTime();
                $now->setTimezone(new DateTimeZone('GMT+8'));
                $peserta_konfirmasi->update([
                    'waktu_mulai' => $now
                ]);

                $waktu_selesai = new DateTime($now->format('Y-m-d H:i:s').'GMT+8');
                $waktu_selesai->add(new DateInterval('PT'.$subtes->durasi.'M'));
                $peserta_konfirmasi->update([
                    'waktu_selesai' => $waktu_selesai
                ]);
                $diff = $peserta_konfirmasi->waktu_mulai->diff($peserta_konfirmasi->waktu_selesai);
                // dd($diff->format('%h hours %i min %s sec '), $peserta_konfirmasi->waktu_mulai, $peserta_konfirmasi->waktu_selesai);
            }
            
            // dd($data_tryout, $data_soal, $data_jawaban, $data_jawaban_peserta, $data_semua_jawaban_peserta);
            return view('to/kerja-to', [
                'data_tryout' => $data_tryout,
                'data_soal' => $data_soal,
                'no' => $no,
                'data_jawaban' => $data_jawaban,
                'data_jawaban_peserta' => $data_jawaban_peserta,
                'array_jawaban' => $array_jawaban,
                'array_jawaban_ragu' => $array_jawaban_ragu,
                'data_peserta' => $data_peserta
                ]);  
        }
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

    public function showPesertaDikonfirmasi()
    {
        $data_peserta_dikonfirmasi = DB::table('peserta_konfirmasi')
            ->where('status', '<>' ,'Menunggu Pembayaran')
            ->join('users', 'users.id', '=', 'peserta_konfirmasi.id_peserta')
            ->join('tryout', 'tryout.id', '=', 'peserta_konfirmasi.id_tryout')
            ->select('peserta_konfirmasi.*', 'users.*', 'tryout.nama', 'users.id as id_user', 'tryout.id as id_tryout', 'peserta_konfirmasi.id as id_peserta_konfirmasi')
            ->get();
        
        // dd($data_peserta_konfirmasi);
        return view('admin/setting-try-out/peserta-dikonfirmasi', [
            'data_peserta_dikonfirmasi' => $data_peserta_dikonfirmasi
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
                // $data = Tryout::find($id_to);
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
        
        $to = DB::table('tryout')
            ->where('id', $id_to)
            ->get();

        if ($check_kode->count() > 0) {
            if ($check_kode[0]->kode_unik == $request->kode_unik ) {
                if (strtolower($check_kode[0]->status) == "telah ujian") {
                    return redirect()->back()->with('failed', 'Anda telah mengikuti ujian ini');    
                }
                $request->session()->put('loginTO', [
                    'id' => $id,
                    'id_peserta' => $check_kode[0]->id,
                    'id_to' => $id_to ]);
                
                $array_soal = str_replace(["\"", "[", "]"], "", $to[0]->soal);
                $array_soal = explode(",", $array_soal);
                // dd($array_soal);
                foreach($array_soal as $soal) {
                    $check_answered = DB::table('jawaban_peserta')
                        ->where('id_peserta', $check_kode[0]->id)
                        ->where('id_soal', $soal)
                        ->get();
                    if (count($check_answered) < 1) {
                        DB::table('jawaban_peserta')->insert([
                                'id_peserta' => $check_kode[0]->id,
                                'id_jawaban' => 0,
                                'id_soal' => $soal
                            ]);
                    }
                }

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

                $tps = DB::table('subtes')
                    ->where('kategori', 'TPS')
                    ->get();
                $saintek = DB::table('subtes')
                ->where('kategori', 'SAINTEK')
                ->get();
                $soshum = DB::table('subtes')
                    ->where('kategori', 'SOSHUM')
                    ->get();

                $peraturan = PeraturanTO::all();
                    
                // dd($peraturan);
                return view('to/list-to', [
                    'data' => $data,
                    'tps' => $tps,
                    'saintek' => $saintek,
                    'soshum' => $soshum,
                    'peraturan' => $peraturan
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
            ->where('jawaban_peserta.id_peserta', $id_peserta)
            ->get();

        $data_input = [
            'id_peserta' => $id_peserta,
            'id_soal' => $id_soal,
            'id_jawaban' => $id_jawaban
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
            ->where('id_peserta', $id_peserta)
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

    public function ujianFinish(Request $request, $id_to, $id_peserta) {
        $data = DB::table('peserta_konfirmasi')
            ->where('id_tryout', $id_to)
            ->where('id_peserta', $id_peserta)
            ->get();
        
        $data_to = DB::table('tryout')
            ->where('id', $id_to)
            ->get();

        $peserta = PesertaKonfirmasi::find($data[0]->id);
        $peserta->update(['status' => 'Telah Ujian']);

        $request->session()->forget('loginTO');
        $request->session()->forget('subtes');
        return view('to/finish-ujian', [
            'data_to' => $data_to
        ]);
    } 
    
    public function getEndTime($id_peserta)
    {
        $peserta = PesertaKonfirmasi::find($id_peserta);

        echo json_encode($peserta);
    }
    
    public function resetTime(Request $request, $id_peserta, $id_subtes)
    {
        $peserta = PesertaKonfirmasi::find($id_peserta);
        if ($peserta->subtes_done != null) {
            $peserta->update(['subtes_done' => $peserta->subtes_done .',' .$id_subtes]);
        } else {
            $peserta->update(['subtes_done' => $id_subtes]);
        }
        $peserta->update([
            'waktu_mulai' => null,
            'waktu_selesai' => null,
        ]);
        $request->session()->forget('subtes');
        if ($id_subtes < 6) {
            if ($id_subtes == 5) {
                return redirect(route('tryout.index', $peserta->id_tryout))->with('success', 'Anda telah mengerjakan kategori soal TPS');
            } else {
                return redirect(route('showSoal', [$peserta->id_tryout, $id_subtes+1, 1]));
            }
        } else if ($id_subtes < 10) {
            if ($id_subtes == 9) {
                return redirect(route('ujian.finish', [$peserta->id_tryout, $request->session()->get('loginTO')['id']]));
                // return redirect(route('tryout.index', $peserta->id_tryout))->with('success', 'Anda telah mengerjakan kategori soal TKA SAINTEK');
            } else {
                return redirect(route('showSoal', [$peserta->id_tryout, $id_subtes+1, 1]));
            }
        } else {
            if ($id_subtes == 13) {
                return redirect(route('ujian.finish', [$peserta->id_tryout, $request->session()->get('loginTO')['id']]));
                // return redirect(route('tryout.index', $peserta->id_tryout))->with('success', 'Anda telah mengerjakan kategori soal TKA SOSHUM');
            } else {
                return redirect(route('showSoal', [$peserta->id_tryout, $id_subtes+1, 1]));
            }
        }
    }
}
