<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $soal_pu = [];
        $soal_pbm = [];
        $soal_ppu = [];
        $soal_pk = [];
        $soal_bi = [];

        $soal_msa = [];
        $soal_f = [];
        $soal_k = [];
        $soal_b = [];

        $soal_mso = [];
        $soal_e = [];
        $soal_g = [];
        $soal_ss = [];

        // TAKE ALL DATA SOAL BASED ON SUBTES
        foreach ($data_tryout as $data_to) {
            foreach ($data_to->soal as $soal) {
                $check_subtes = Soal::where('id', $soal)->get()->first();
                switch ($check_subtes->subtes) {
                    case "PENALARAN UMUM":
                        array_push($soal_pu, $check_subtes);
                    break;
                    case "PEMAHAMAN BACAAN DAN MENULIS":
                        array_push($soal_pbm, $check_subtes);
                    break;
                    case "PENGETAHUAN DAN PEMAHAMAN UMUM":
                        array_push($soal_ppu, $check_subtes);
                    break;
                    case "PENGETAHUAN KUANTITATIF":
                        array_push($soal_pk, $check_subtes);
                    break;
                    case "BAHASA INGGRIS":
                        array_push($soal_bi, $check_subtes);
                    break;
                    case "MATEMATIKA SAINTEK":
                        array_push($soal_msa, $check_subtes);
                    break;
                    case "FISIKA":
                        array_push($soal_f, $check_subtes);
                    break;
                    case "KIMIA":
                        array_push($soal_k, $check_subtes);
                    break;
                    case "BIOLOGI":
                        array_push($soal_b, $check_subtes);
                    break;
                    case "MATEMATIKA SOSHUM":
                        array_push($soal_mso, $check_subtes);
                    break;
                    case "EKONOMI":
                        array_push($soal_e, $check_subtes);
                    break;
                    case "GEOGRAFI":
                        array_push($soal_g, $check_subtes);
                    break;
                    case "SOSIOLOGI DAN SEJARAH":
                        array_push($soal_ss, $check_subtes);
                    break;
                }
            }
        }
        // dd(count($soal_pu));
        
        return view('admin/setting-try-out/index', [
            'data_tryout' => $data_tryout,
            'soal_pu' => $soal_pu,
            'soal_pbm' => $soal_pbm,
            'soal_ppu' => $soal_ppu,
            'soal_pk' => $soal_pk,
            'soal_bi' =>$soal_bi,
    
            'soal_msa' => $soal_msa,
            'soal_f' => $soal_f,
            'soal_k' => $soal_k,
            'soal_b' => $soal_b,
    
            'soal_mso' => $soal_mso,
            'soal_e' => $soal_e,
            'soal_g' => $soal_g,
            'soal_ss' => $soal_ss
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    

    public function create()
    {   
        function getSoal($subtes) {
            return DB::table('soal')
                    ->where('subtes', $subtes)
                    ->get()
                    ->all();
        }

        $soal_pu = getSoal('penalaran umum');
        $soal_pbm = getSoal('pemahaman bacaan dan menulis');
        $soal_ppu = getSoal('pengetahuan dan pemahaman umum');
        $soal_pk = getSoal('pengetahuan kuantitatif');
        $soal_bi = getSoal('bahasa inggris');

        $soal_msa = getSoal('matematika saintek');
        $soal_f = getSoal('fisika');
        $soal_k = getSoal('kimia');
        $soal_b = getSoal('biologi');

        $soal_mso = getSoal('matematika soshum');
        $soal_e = getSoal('ekonomi');
        $soal_g = getSoal('geografi');
        $soal_ss = getSoal('sosiologi dan sejarah');
        
        return view('admin/setting-try-out/create', [
            'soal_pu' => $soal_pu,
            'soal_pbm' => $soal_pbm,
            'soal_ppu' => $soal_ppu,
            'soal_pk' => $soal_pk,
            'soal_bi' => $soal_bi,

            'soal_msa' => $soal_msa,
            'soal_f' => $soal_f,
            'soal_k' => $soal_k,
            'soal_b' => $soal_b,

            'soal_mso' => $soal_mso,
            'soal_e' => $soal_e,
            'soal_g' => $soal_g,
            'soal_ss' => $soal_ss,
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
}
