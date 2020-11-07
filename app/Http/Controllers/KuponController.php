<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kupon;
use Illuminate\Validation\Rule;

class KuponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_kupon = DB::table('kupon')
            ->join('tryout', 'tryout.id', '=', 'kupon.id_tryout')
            ->select('tryout.nama','kupon.*', 'tryout.id as id_tryout', 'kupon.id as id_kupon')
            ->get();
        
        // dd($data_kupon);
        return view('admin/kupon/index', [
            'data_kupon' => $data_kupon
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_tryout = DB::table('tryout')->get()->all();
        return view('admin/kupon/create', [
            'data_tryout' => $data_tryout
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
            'kode_kupon' => ['unique:kupon','required', 'string', 'max:255'],
            'persen' => ['required', 'integer', 'min:0']
        ]);
        
        Kupon::create($request->all());
        return redirect(route('kupon.index'))->with('success', 'Data Berhasil Ditambahkan.');
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
        $data_kupon = DB::table('kupon')
            ->where('kupon.id', $id)
            ->join('tryout', 'tryout.id', '=', 'kupon.id_tryout')
            ->select('tryout.nama', 'kupon.*', 'tryout.id as id_tryout', 'kupon.id as id_kupon')
            ->get();
        
        // dd($data_kupon);

        return view('admin/kupon/edit', [
            'data' => $data_kupon
        ]);
    }

    public function getTryout()
    {
        $data = DB::table('tryout')
            ->get()
            ->all();

        echo json_encode($data);
    }

    public function getKupon($id_to)
    {
        $data = DB::table('kupon')
            ->where('kupon.id_tryout', $id_to)
            ->get();
        
        // dd($data);

        echo json_encode($data);
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
            'kode_kupon' => ['required', 'string', 'max:255', Rule::unique('kupon')->ignore($id)],
            'persen' => ['required', 'integer', 'min:0']
        ]);

        $kupon = Kupon::find($id);
        $kupon->update($request->all());
        return redirect(route('kupon.index'))->with('success', 'Data berhasil di-update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kupon = Kupon::find($id);
        $kupon->delete();

        return redirect(route('kupon.index'))->with('success', 'Data berhasil dihapus');
    }
}
