<?php

namespace App\Http\Controllers;

use App\Models\JawabanPeserta;
use App\Models\NilaiPeserta;
use App\Models\PesertaKonfirmasi;
use App\Models\Subtes;
use App\Models\Tryout;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryTOController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('tryout')
            ->where('tryout.waktu_selesai', '>', now())
            ->get();
            
        $peserta = [];
        foreach ($data as $data_to) {
            $peserta_join = DB::table('peserta_konfirmasi')
            ->where('peserta_konfirmasi.id_tryout', $data_to->id)
            ->where('status', 'Telah Ujian')
            ->get();
            array_push($peserta, count($peserta_join));
        }
        
        // dd($data);

        return view('admin/setting-try-out/history/index', [
            'data' => $data,
            'peserta' => $peserta
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id_to)
    {
        $data = Tryout::find($id_to);
        $data_subtes = Subtes::all();
        
        if ($request->subtes == null) {
            $request->subtes = '1';
        }

        $array_soal = [];
        foreach($data->soal as $soal) {
            $cek_subtes = Soal::find($soal);
            if ($cek_subtes->subtes == $request->subtes) {
                array_push($array_soal, $soal);
            }
        }

        $saintek = ['6','7','8','9'];
        $soshum = ['10','11','12','13'];
        $tps = ['1','2','3','4','5'];
        
        $klp_ujian = null;
        if (!in_array($request->subtes, $tps)) {
            if (in_array($request->subtes, $saintek)) {
                $klp_ujian = 'SAINTEK';
            } else if (in_array($request->subtes, $soshum)) {
                $klp_ujian = 'SOSHUM';
            }
        }

        $peserta_model = new PesertaKonfirmasi;
        $data_peserta = $peserta_model->getRekapPeserta($id_to, $request->subtes, $klp_ujian);
        
        $jawaban_peserta = DB::table('jawaban_peserta')
            ->where('peserta_konfirmasi.id_tryout', $id_to)
            ->leftJoin('peserta_konfirmasi', 'peserta_konfirmasi.id', '=', 'jawaban_peserta.id_peserta')
            ->leftJoin('soal', 'soal.id', '=', 'jawaban_peserta.id_soal')
            ->leftJoin('jawaban', 'jawaban.id', '=', 'jawaban_peserta.id_jawaban')
            ->where('soal.subtes', $request->subtes)
            ->orderBy('jawaban_peserta.id_peserta')
            ->orderBy('jawaban_peserta.id_soal')
            ->select('jawaban.value', 'jawaban_peserta.*', 'soal.subtes')
            ->get();
        
        return view('admin/setting-try-out/history/detail', [
            'data' => $data,
            'data_subtes' => $data_subtes,
            'data_peserta' => $data_peserta,
            'subtes_now' => $request->subtes,
            'array_soal' => $array_soal,
            'jawaban_peserta' => $jawaban_peserta
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
    }

    public function editNilai($id_to, $id_subtes, $id_peserta)
    {
        $subtes = Subtes::find($id_subtes);
        $data = Tryout::find($id_to);
        $peserta = DB::table('peserta_konfirmasi')
            ->where('peserta_konfirmasi.id', $id_peserta)
            ->join('users', 'users.id', '=', 'peserta_konfirmasi.id_peserta')
            ->leftJoin('nilai_peserta', 'nilai_peserta.id_peserta', '=', 'peserta_konfirmasi.id')
            ->select('users.id as id_users', 'users.name', 'peserta_konfirmasi.*', 'nilai_peserta.*', 'nilai_peserta.id as id_nilai_peserta', 'peserta_konfirmasi.id as id')
            ->get();
        
        // dd($peserta);
        return view('admin/setting-try-out/history/edit', [
                'data'=>$data,
                'subtes'=>$subtes,
                'peserta'=>$peserta
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

    }

    public function updateNilai(Request $request, $id_to, $id_subtes, $id_peserta)
    {   
        $request->validate([
            'nilai' => ['integer']
        ]);
        // dd($id_peserta);
        $nilai_peserta = DB::table('nilai_peserta')
            ->where('id_peserta', $id_peserta)
            ->where('id_subtes', $id_subtes)
            ->get();
        if (count($nilai_peserta)>0) {
            $peserta = NilaiPeserta::find($nilai_peserta[0]->id);
            $peserta->update($request->all());
        } else {
            DB::table('nilai_peserta')
                ->insert([
                    'id_peserta' => $id_peserta,
                    'id_subtes' => $id_subtes,
                    'nilai' => $request->nilai,
                ]);
        }
        return redirect(route('history-try-out.show', $id_to))->with('success', 'Data berhasil di-update');
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
}
