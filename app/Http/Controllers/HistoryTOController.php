<?php

namespace App\Http\Controllers;

use App\Models\Subtes;
use App\Models\Tryout;
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
            ->where('tryout.waktu_selesai', '<', now())
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
        // $request->subtes = "1";
        $data = Tryout::find($id_to);
        $data_subtes = Subtes::all();
        $data_peserta = DB::table('peserta_konfirmasi')
            ->where('id_tryout', $id_to)
            ->where('status', 'Telah Ujian')
            ->join('users', 'users.id', '=', 'peserta_konfirmasi.id_peserta')
            ->select('peserta_konfirmasi.*', 'users.name',
                DB::raw("(select count(jawaban_peserta.id)
                    from jawaban_peserta 
                    join jawaban on jawaban.id = jawaban_peserta.id_jawaban
                    left join soal on soal.id = jawaban_peserta.id_soal
                    where jawaban.value = 1 and jawaban_peserta.id_peserta = peserta_konfirmasi.id_peserta
                    and soal.subtes = $request->subtes
                    ) as benar"
                ),
                DB::raw("(select count(jawaban_peserta.id)
                    from jawaban_peserta 
                    join jawaban on jawaban.id = jawaban_peserta.id_jawaban
                    left join soal on soal.id = jawaban_peserta.id_soal
                    where jawaban.value = 0 and jawaban_peserta.id_peserta = peserta_konfirmasi.id_peserta
                    and soal.subtes = $request->subtes
                    ) as salah"
                ),
                DB::raw("(select count(jawaban_peserta.id)
                    from jawaban_peserta 
                    left join soal on soal.id = jawaban_peserta.id_soal
                    where jawaban_peserta.id_jawaban = 0 and jawaban_peserta.id_peserta = peserta_konfirmasi.id_peserta
                    and soal.subtes = $request->subtes
                    ) as kosong"
                ),
            )
            ->get();
        
        // dd($data_peserta);

        return view('admin/setting-try-out/history/detail', [
            'data' => $data,
            'data_subtes' => $data_subtes,
            'data_peserta' => $data_peserta,
            'subtes_now' => $request->subtes
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
}
