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

        // dd($data_tryout);

        // $soal_pu = [];
        // $soal_pbm = [];
        // $soal_ppu = [];
        // $soal_pk = [];
        // $soal_bi = [];

        // $soal_msa = [];
        // $soal_f = [];
        // $soal_k = [];
        // $soal_b = [];

        // $soal_mso = [];
        // $soal_e = [];
        // $soal_g = [];
        // $soal_ss = [];

        // TAKE ALL DATA SOAL BASED ON SUBTES
        // foreach ($data_tryout as $data_to) {
        //     if (!empty($data_to->soal)) {
        //         // dd($data_to->soal);
        //         foreach ($data_to->soal as $soal) {
        //             // dd($soal);
        //             $check_subtes = Soal::where('id', $soal)->get()->first();
        //             // dd($check_subtes);
        //             switch ($check_subtes->subtes) {
        //                 case "PENALARAN UMUM":
        //                     array_push($soal_pu, $check_subtes);
        //                 break;
        //                 case "PEMAHAMAN BACAAN DAN MENULIS":
        //                     array_push($soal_pbm, $check_subtes);
        //                 break;
        //                 case "PENGETAHUAN DAN PEMAHAMAN UMUM":
        //                     array_push($soal_ppu, $check_subtes);
        //                 break;
        //                 case "PENGETAHUAN KUANTITATIF":
        //                     array_push($soal_pk, $check_subtes);
        //                 break;
        //                 case "BAHASA INGGRIS":
        //                     array_push($soal_bi, $check_subtes);
        //                 break;
        //                 case "MATEMATIKA SAINTEK":
        //                     array_push($soal_msa, $check_subtes);
        //                 break;
        //                 case "FISIKA":
        //                     array_push($soal_f, $check_subtes);
        //                 break;
        //                 case "KIMIA":
        //                     array_push($soal_k, $check_subtes);
        //                 break;
        //                 case "BIOLOGI":
        //                     array_push($soal_b, $check_subtes);
        //                 break;
        //                 case "MATEMATIKA SOSHUM":
        //                     array_push($soal_mso, $check_subtes);
        //                 break;
        //                 case "EKONOMI":
        //                     array_push($soal_e, $check_subtes);
        //                 break;
        //                 case "GEOGRAFI":
        //                     array_push($soal_g, $check_subtes);
        //                 break;
        //                 case "SOSIOLOGI DAN SEJARAH":
        //                     array_push($soal_ss, $check_subtes);
        //                 break;
        //             }
        //         }

        //         $data_to->soal = [];
        //         dd($data_to->soal);
        //         array_push($data_to->soal, $soal_pu);
        //         dd($data_to->soal);
        //     }
        // }
        // dd($soal_pu);
        
        return view('admin/setting-try-out/index', [
            'data_tryout' => $data_tryout
            // 'soal_pu' => $soal_pu,
            // 'soal_pbm' => $soal_pbm,
            // 'soal_ppu' => $soal_ppu,
            // 'soal_pk' => $soal_pk,
            // 'soal_bi' =>$soal_bi,
    
            // 'soal_msa' => $soal_msa,
            // 'soal_f' => $soal_f,
            // 'soal_k' => $soal_k,
            // 'soal_b' => $soal_b,
    
            // 'soal_mso' => $soal_mso,
            // 'soal_e' => $soal_e,
            // 'soal_g' => $soal_g,
            // 'soal_ss' => $soal_ss
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
        function getSoal2($subtes) {
            return DB::table('soal')
                    ->where('subtes', $subtes)
                    ->get()
                    ->all();
        }

        $data_soal_pu = getSoal2('penalaran umum');
        $data_soal_pbm = getSoal2('pemahaman bacaan dan menulis');
        $data_soal_ppu = getSoal2('pengetahuan dan pemahaman umum');
        $data_soal_pk = getSoal2('pengetahuan kuantitatif');
        $data_soal_bi = getSoal2('bahasa inggris');

        $data_soal_msa = getSoal2('matematika saintek');
        $data_soal_f = getSoal2('fisika');
        $data_soal_k = getSoal2('kimia');
        $data_soal_b = getSoal2('biologi');

        $data_soal_mso = getSoal2('matematika soshum');
        $data_soal_e = getSoal2('ekonomi');
        $data_soal_g = getSoal2('geografi');
        $data_soal_ss = getSoal2('sosiologi dan sejarah');

        $data_tryout = Tryout::find($id);

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

        foreach ($data_tryout->soal as $soal) {
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

        return view('admin/setting-try-out/edit', [
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
            'soal_ss' => $soal_ss,

            'data_soal_pu' => $data_soal_pu,
            'data_soal_pbm' => $data_soal_pbm,
            'data_soal_ppu' => $data_soal_ppu,
            'data_soal_pk' => $data_soal_pk,
            'data_soal_bi' =>$data_soal_bi,
    
            'data_soal_msa' => $data_soal_msa,
            'data_soal_f' => $data_soal_f,
            'data_soal_k' => $data_soal_k,
            'data_soal_b' => $data_soal_b,
    
            'data_soal_mso' => $data_soal_mso,
            'data_soal_e' => $data_soal_e,
            'data_soal_g' => $data_soal_g,
            'data_soal_ss' => $data_soal_ss
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
