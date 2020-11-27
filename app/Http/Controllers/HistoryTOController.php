<?php

namespace App\Http\Controllers;

use App\Models\JawabanPeserta;
use App\Models\NilaiPeserta;
use App\Models\PesertaKonfirmasi;
use App\Models\Subtes;
use App\Models\Tryout;
use App\Models\Soal;
use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;

class HistoryTOController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = new DateTime();
        $now->setTimezone(new DateTimeZone('GMT+8'));
        $data = DB::table('tryout')
            ->where('tryout.waktu_selesai', '<', $now)
            ->get();
        $data_subtes = DB::table('subtes')->get()->all();
        $data_soal = DB::table('soal')->get()->all();
            
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
            'peserta' => $peserta,
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
    public function showNilai(Request $request, $id_to, $id_subtes = null, $download = false)
    {
        $data = Tryout::find($id_to);
        $data_subtes = Subtes::all();
        
        if ($request->subtes == null) {
            if ($id_subtes == null) {
                $request->subtes = '1';
            } else {
                $request->subtes = $id_subtes;
            }
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
        if ($download) {
            // $column_name = ['nama', 'kelas', 'benar', 'salah', 'kosong', 'nilai'];
            // for($i=1; $i<=count($array_soal); $i++) {
            //     array_push($column_name, 'no.' . $i);
            // }
            $collect = new Collection();
            // $collect[0] = (object) $column_name;

            foreach($data_peserta as $peserta) {
                $array = [
                    'Nama' => $peserta->name,
                    'Kelas' => $peserta->kelompok_ujian,
                    'Benar' => $peserta->benar,
                    'Salah' => $peserta->salah,
                    'Kosong' => $peserta->kosong,
                    'Nilai' => $peserta->nilai
                ];
                $j = 1;
                $rekap = [];
                foreach($jawaban_peserta as $jawaban) {
                    if ($jawaban->id_peserta == $peserta->id) {
                        if ($jawaban->value == 1) {
                            $bg ="v";
                        } else if (is_null($jawaban->value)) {
                            $bg ="-";
                        } else if ($jawaban->value == 0) {
                            $bg ="x";
                        }
                        $array['No.'.$j++] = $bg;
                    }
                }
                $collect->push($array);
            }
            $subtes = Subtes::find($request->subtes);
            return (new FastExcel($collect))->download('rekap-nilai_' . $data->nama . '_' . $subtes->nama . '.xlsx');
        } else {
            return view('admin/setting-try-out/history/detail', [
                'data' => $data,
                'data_subtes' => $data_subtes,
                'data_peserta' => $data_peserta,
                'subtes_now' => $request->subtes,
                'array_soal' => $array_soal,
                'jawaban_peserta' => $jawaban_peserta
            ]);
        }
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
            ->select('users.id as id_users', 'users.name', 'peserta_konfirmasi.*')
            ->get();
        
        $nilai = DB::table('nilai_peserta')
            ->where('nilai_peserta.id_peserta', $id_peserta)
            ->where('nilai_peserta.id_subtes', $id_subtes)
            ->get();

        // dd($nilai);
        return view('admin/setting-try-out/history/edit', [
                'data'=> $data,
                'subtes'=> $subtes,
                'peserta'=> $peserta,
                'nilai' => $nilai
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
        return redirect(route('show-nilai.show', [$id_to, $id_subtes, 0]))->with('success', 'Data berhasil di-update');
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

    public function tryoutPublish($id_to)
    {
        $data_peserta = DB::table('peserta_konfirmasi')
            ->where('id_tryout', $id_to)
            ->get();

        // dd($data_peserta);
        $i = 0;
        foreach ($data_peserta as $data) {
            $notif = DB::table('notifikasi')
                ->where('notifikasi.id_peserta', $data->id)
                ->where('judul', 'Hasil Try Out')
                ->get();

            if (count($notif) > 0) {
                ++$i;
            } else {
                DB::table('notifikasi')->insert([
                    'id_peserta' => $data->id,
                    'pengirim' => 'System',
                    'judul' => 'Hasil Try Out',
                    'isi' => '',
                    'read' => false
                    ]);
            }
        }

        if ($i > 0) {
            return redirect()->back()->with('success', 'Hasil Try Out sudah di-publish');
        } else {
            return redirect()->back()->with('success', 'Data Hasil Try Out berhasil di-publish');
        }
    }

    public function showRanking($id_to)
    {
        $data_peserta = DB::table('peserta_konfirmasi')
            ->where('peserta_konfirmasi.id_tryout', $id_to)
            ->where('peserta_konfirmasi.status', 'Telah Ujian')
            ->join('users', 'users.id', '=', 'peserta_konfirmasi.id_peserta')
            ->select('users.*', 'peserta_konfirmasi.kelompok_ujian', 'peserta_konfirmasi.id as id_peserta', 'users.id as id_user')
            ->get();
        
        $data_nilai = DB::table('nilai_peserta')
            ->get();

        $data_to = Tryout::find($id_to);
        $data_subtes = Subtes::all();
        // dd($data_peserta);
        return view('admin/setting-try-out/history/ranking', [
                'data_peserta' => $data_peserta,
                'data_nilai' => $data_nilai,
                'data_to' => $data_to,
                'data_subtes' => $data_subtes
        ]);
    }
}
