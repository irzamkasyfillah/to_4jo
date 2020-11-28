<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Intervention\Image\ImageManagerStatic as Image;

class UserProfileController extends Controller
{
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
        return view('profile');
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
        $user = User::find($id);
        return view('profile', ['user' => $user]);
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
        $user = User::findOrFail($id);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'foto' => ['nullable', 'image', 'max:5120']
        ]);

        $photo = $request->file('foto');
        if ($photo != ''){
            $photo_name = time() . '.' . $photo->getClientOriginalExtension();
            $photo_resize = Image::make($photo->getRealPath());
            $photo_resize->resize(null, 100, function ($constraint) {
                $constraint->aspectRatio();
            });
            $photo_resize->save(public_path('uploads/' . '100_' . $photo_name));
            $photo_resize2 = Image::make($photo->getRealPath());
            $photo_resize2->resize(null, 225,  function ($constraint) {
                $constraint->aspectRatio();
            });
            $photo_resize2->save(public_path('uploads/' . '225_' . $photo_name));
            $photo->move('uploads', $photo_name);

            $photo_path = "uploads/$user->foto";
            if (File::exists($photo_path)) {
                File::delete($photo_path);
                File::delete('100_'.$photo_path);
                File::delete('225_'.$photo_path);
            }
        } else {
            $photo_name = $user->foto;
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir' => $request->tgl_lahir,
            'hp' => $request->hp,
            'instagram' => $request->instagram,
            'foto' => $photo_name,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'nama_sekolah' => $request->nama_sekolah,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'tahun_lulus' => $request->tahun_lulus
        ];
        
        $user->update($data);
        return redirect()->route('profile.index')->with('success', 'Data berhasil di-update.');
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
