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

    public function __construct()
    {
        $this->middleware('auth');
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
            'deskripsi' => ['required', 'string', 'max:1024'],
            'jawaban_benar' => ['nullable', 'string', 'max:512'],
            'jawaban_salah_1' => ['nullable', 'string', 'max:512'],
            'jawaban_salah_2' => ['nullable', 'string', 'max:512'],
            'jawaban_salah_3' => ['nullable', 'string', 'max:512'],
            'jawaban_salah_4' => ['nullable', 'string', 'max:512']
        ]);

        $data_soal = [
            'kategori' => $request->kategori,
            'subtes' => $request->subtes,
            'deskripsi' => $request->deskripsi
        ];

        $soal = Soal::create($data_soal);

        // dd($soal->id);

        DB::table('jawaban')->insert([
            ['id_soal' => $soal->id, 'teks' => $request->jawaban_benar, 'value' => true],
            ['id_soal' => $soal->id, 'teks' => $request->jawaban_salah_1, 'value' => false],
            ['id_soal' => $soal->id, 'teks' => $request->jawaban_salah_2, 'value' => false],
            ['id_soal' => $soal->id, 'teks' => $request->jawaban_salah_3, 'value' => false],
            ['id_soal' => $soal->id, 'teks' => $request->jawaban_salah_4, 'value' => false]
        ]);
    
        return redirect('/soal/kategori/'. strtolower($soal->kategori))->with('success', 'Data Berhasil Ditambahkan.');
    }



    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
        
            $request->file('upload')->move(public_path('images'), $fileName);
   
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/'.$fileName); 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
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
            ->select('soal.*', 'soal.id as id_soal', 'subtes.nama as nama_subtes')
            ->get();

        $jawaban = DB::table('jawaban')
            ->where('id_soal', $data[0]->id)
            ->get();

        // dd($jawaban);

        return view('admin/bank-soal/edit', [
            'data' => $data,
            'jawaban' => $jawaban]);
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
            'deskripsi' => ['required', 'string', 'max:1024'],
        ]);

        $data_soal = [
            'kategori' => $request->kategori,
            'subtes' => $request->subtes,
            'deskripsi' => $request->deskripsi
        ];

        $soal = Soal::find($id_soal);
        $soal->update($data_soal);

        $id_jawaban = $request->id_jawaban;
        $jawaban = $request->jawaban;
        
        for ($i=0; $i<count($id_jawaban); $i++) {
            $jawab = Jawaban::find($id_jawaban[$i]);
            $data_jawaban = [
                'teks' => $jawaban[$i]
            ];
            $jawab->update($data_jawaban);
        }
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

        $jawaban = Jawaban::where('id_soal', $id)->get()->all();
        foreach ($jawaban as $jawaban) {
            $jawaban->delete();
        }

        return redirect('/soal/kategori/'. strtolower($kategori))->with('success', 'Data Berhasil Dihapus.');
    }

    public function showCategory($kategori)
    {   
        $data = DB::table('soal')
            ->where('soal.kategori', $kategori)
            ->leftJoin('subtes', 'subtes.id', '=', 'soal.subtes')
            ->select('soal.*', 'soal.id as id_soal', 'subtes.nama as nama_subtes')
            ->get();
        
        return view('admin/bank-soal/index', [
                                        'kategori' => $kategori,
                                        'data' => $data]);
    }

    public function getJawaban($id_soal) {
        $data = DB::table('jawaban')
            ->where('jawaban.id_soal', $id_soal)
            ->join('soal', 'soal.id', '=', 'jawaban.id_soal')
            ->select('jawaban.*', 'soal.deskripsi','jawaban.id as id_jawaban', 'soal.id as id_soal')
            ->get();
        // dd($data);
        echo json_encode($data);
    }
}
