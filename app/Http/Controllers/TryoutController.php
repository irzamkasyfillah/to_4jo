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
}
