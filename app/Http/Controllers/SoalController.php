<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\Jawaban;
use Illuminate\Support\Facades\DB;

class SoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/bank-soal/create');
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
            'kategori' => ['required', 'string', 'max:255'],
            'subtes' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string', 'max:255'],
            'jawaban_benar' => ['nullable', 'string', 'max:255'],
            'jawaban_salah_1' => ['nullable', 'string', 'max:255'],
            'jawaban_salah_2' => ['nullable', 'string', 'max:255'],
            'jawaban_salah_3' => ['nullable', 'string', 'max:255'],
            'jawaban_salah_4' => ['nullable', 'string', 'max:255']
        ]);

        $data_soal = [
            'kategori' => $request->kategori,
            'subtes' => $request->subtes,
            'deskripsi' => $request->deskripsi
        ];

        $soal = Soal::create($data_soal);

        $data_jawaban = [
            'id_soal' => $soal->id,
            'jawaban_benar' => $request->jawaban_benar,
            'jawaban_salah_1' => $request->jawaban_salah_1,
            'jawaban_salah_2' => $request->jawaban_salah_2,
            'jawaban_salah_3' => $request->jawaban_salah_3,
            'jawaban_salah_4' => $request->jawaban_salah_4
        ];

        Jawaban::create($data_jawaban);

        // return view('admin/bank-soal/index', ['kategori' => $request->kategori])->with('success', 'Data Berhasil Ditambahkan.');
        return redirect('/soal/kategori/'. strtolower($soal->kategori))->with('success', 'Data Berhasil Ditambahkan.');
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

    public function getSubtes($kategori)
    {
        $data = DB::table('subtes')->where('kategori', $kategori)->get()->all();
        echo json_encode($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('soal')
        ->where('soal.id', $id)
        ->leftJoin('subtes', 'subtes.id', '=', 'soal.subtes')
        ->leftJoin('jawaban', 'soal.id', '=', 'jawaban.id_soal')
        ->select('soal.*', 'jawaban.*', 'soal.id as id_soal', 'jawaban.id as id_jawaban', 'subtes.nama as nama_subtes')
        ->get();

        // dd($data);

        return view('admin/bank-soal/edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_soal)
    {
        $request->validate([
            'kategori' => ['required', 'string', 'max:255'],
            'subtes' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string', 'max:255'],
            'jawaban_benar' => ['required', 'string', 'max:255'],
            'jawaban_salah_1' => ['required', 'string', 'max:255'],
            'jawaban_salah_2' => ['required', 'string', 'max:255'],
            'jawaban_salah_3' => ['required', 'string', 'max:255'],
            'jawaban_salah_4' => ['required', 'string', 'max:255']
        ]);

        $data_soal = [
            'kategori' => $request->kategori,
            'subtes' => $request->subtes,
            'deskripsi' => $request->deskripsi
        ];

        $soal = Soal::find($id_soal);
        $soal->update($data_soal);

        $data_jawaban = [
            'id_soal' => $soal->id,
            'jawaban_benar' => $request->jawaban_benar,
            'jawaban_salah_1' => $request->jawaban_salah_1,
            'jawaban_salah_2' => $request->jawaban_salah_2,
            'jawaban_salah_3' => $request->jawaban_salah_3,
            'jawaban_salah_4' => $request->jawaban_salah_4
        ];

        $jawaban = Jawaban::where('id_soal', $id_soal)->first();
        $jawaban->update($data_jawaban);

        return redirect('/soal/kategori/'. strtolower($request->kategori))->with('success', 'Data Berhasil Di-update.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $soal = Soal::find($id);
        $kategori = $soal->kategori;
        $soal->delete();

        $jawaban = Jawaban::where('id_soal', $id)->first();
        $jawaban->delete();

        return redirect('/soal/kategori/'. strtolower($kategori))->with('success', 'Data Berhasil Dihapus.');
    }

    public function showCategory($kategori)
    {   
        $data = DB::table('soal')
            ->where('soal.kategori', $kategori)
            ->leftJoin('subtes', 'subtes.id', '=', 'soal.subtes')
            ->leftJoin('jawaban', 'soal.id', '=', 'jawaban.id_soal')
            ->select('soal.*', 'jawaban.*', 'soal.id as id_soal', 'jawaban.id as id_jawaban', 'subtes.nama as nama_subtes')
            ->get();

        return view('admin/bank-soal/index', [
                                        'kategori' => $kategori,
                                        'data' => $data]);

    }
}
