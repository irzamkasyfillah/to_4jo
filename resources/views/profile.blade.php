@extends('layouts.app')

@section('content')
    @if (Auth::user()->level == 'admin')
        @include('admin.include')
    @else
        @include('layouts.include')
    @endif

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="row">
                    @if ($message = Session::get('success'))
                        <div class="col-xl-12">
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button> 
                                <span style="color:white;" class="text-bold-400">{{ strtoupper($message) }}</span>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-6 col-md-12 clearfix">
                                            <h1>Edit Profile</h1>
                                        </div>
                                    </div>
                                    <hr>
                                    <form enctype="multipart/form-data" class="form-horizontal" method="POST" action="{{ route('profile.update', Auth::user()->id) }}">
                                    <div class="row">
                                        <div class="col-xl-6 mt-2 border-right-grey border-right-lighten-3 clearfix">
                                                @csrf
                                                @method('PUT')
                                                <label for="name">Nama Lengkap</label>
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <input id="name" type="text" value="{{ Auth::user()->name }}" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>

                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <div class="form-control-position">
                                                        <i class="ft-user"></i>
                                                    </div>
                                                </fieldset>
                                                <label for="email">Email</label>
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <input id="email" type="email" value="{{ Auth::user()->email }}" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <div class="form-control-position">
                                                        <i class="ft-mail"></i>
                                                    </div>
                                                </fieldset>
                                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                                <fieldset class="form-group position-relative">
                                                    <select required class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                                        <option <?php echo Auth::user()->jenis_kelamin == "Laki-laki" ?  "selected" : ""  ?> value="Laki-laki">Laki-laki</option>
                                                        <option <?php echo Auth::user()->jenis_kelamin == "Perempuan" ?  "selected" : "" ?> value="Perempuan">Perempuan</option>
                                                    </select>
                                                </fieldset>
                                                <label for="tgl_lahir">Tanggal Lahir</label>
                                                <fieldset class="form-group position-relative">
                                                    <?php 
                                                        if (Auth::user()->tgl_lahir != "") {
                                                            $tgl_lahir = date_format(date_create(Auth::user()->tgl_lahir), "Y-m-d");
                                                        } else {
                                                            $tgl_lahir = "";
                                                        }
                                                    ?>
                                                    <input required id="tgl_lahir" type="date" value="{{ $tgl_lahir }}"  class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir" autocomplete="tanggal lahir">
                                                    @error('tgl_lahir')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </fieldset>
                                                <label for="hp">No. HP</label>
                                                <fieldset class="form-group position-relative">
                                                    <input required id="hp" type="number" value="{{ Auth::user()->hp }}"  class="form-control @error('hp') is-invalid @enderror" name="hp" autocomplete="No. HP">
                                                    @error('hp')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </fieldset>
                                                <label for="hp">Instagram</label>
                                                <fieldset class="form-group position-relative">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">@</span>
                                                        </div>
                                                        <input required id="instagram" type="text" value="{{ Auth::user()->instagram }}"  class="form-control @error('instagram') is-invalid @enderror" name="instagram" autocomplete="instagram">
                                                    </div>
                                                    @error('instagram')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </fieldset>
                                                <label for="foto">Foto Profil</label><br>
                                                <img src="{{ URL::to('/')}}/uploads/{{ Auth::user()->foto }}" class="img-thumbnail" width="50%" alt="Foto"><br><br>
                                                <div class="form-group position-relative">
                                                    <span>Ganti gambar?</span>
                                                    <input name="foto" type="file" class="@error('foto') is-invalid @enderror" id="foto">
                                                    @error('foto')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-6 clearfix">
                                                <h3 class="text-center mb-2 mt-2">Asal Sekolah</h3>
                                                <hr class="col-6">
                                                <label for="provinsi">Provinsi</label>
                                                <fieldset class="form-group position-relative">
                                                    <input id="provinsi" type="text" value="{{ Auth::user()->provinsi }}" class="form-control @error('provinsi') is-invalid @enderror" name="provinsi" autocomplete="provinsi" autofocus>

                                                    @error('provinsi')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </fieldset>
                                                <label for="kota">Kota</label>
                                                <fieldset class="form-group position-relative">
                                                    <input id="kota" type="text" value="{{ Auth::user()->kota }}" class="form-control @error('kota') is-invalid @enderror" name="kota" autocomplete="kota" autofocus>

                                                    @error('kota')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </fieldset>
                                                <label for="nama_sekolah">Nama Sekolah</label>
                                                <fieldset class="form-group position-relative">
                                                    <input id="nama_sekolah" type="text" value="{{ Auth::user()->nama_sekolah }}" class="form-control @error('nama_sekolah') is-invalid @enderror" name="nama_sekolah" required autocomplete="nama_sekolah" autofocus>

                                                    @error('nama_sekolah')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </fieldset>
                                                <label for="kelas">Kelas</label>
                                                <fieldset class="form-group position-relative">
                                                    <select class="form-control" name="kelas" id="kelas">
                                                        <option value="" disabled="" selected="">Pilih Kelas</option>
                                                        <option <?php echo Auth::user()->kelas == "10" ?  "selected" : ""  ?> value="10">10</option>
                                                        <option <?php echo Auth::user()->kelas == "11" ?  "selected" : "" ?> value="11">11</option>
                                                        <option <?php echo Auth::user()->kelas == "12" ?  "selected" : "" ?> value="12">12</option>
                                                        <option <?php echo Auth::user()->kelas == "Alumni" ?  "selected" : "" ?> value="Alumni">Alumni</option>
                                                    </select>
                                                </fieldset>
                                                <label for="jurusan">Jurusan</label>
                                                <fieldset class="form-group position-relative">
                                                    <select class="form-control" name="jurusan" id="jurusan">
                                                        <option value="" disabled="" selected="">Pilih Jurusan</option>
                                                        <option <?php echo Auth::user()->jurusan == "IPA" ?  "selected" : "" ?> value="IPA">IPA</option>
                                                        <option <?php echo Auth::user()->jurusan == "IPS" ?  "selected" : "" ?> value="IPS">IPS</option>
                                                        <option <?php echo Auth::user()->jurusan == "Bahasa" ?  "selected" : ""  ?> value="Bahasa">Bahasa</option>
                                                        <option <?php echo Auth::user()->jurusan == "Keagamaan" ?  "selected" : ""  ?> value="Keagamaan">Keagamaan</option>
                                                        <option <?php echo Auth::user()->jurusan == "SMK Teknik" ?  "selected" : ""  ?> value="SMK Teknik">SMK Teknik</option>
                                                        <option <?php echo Auth::user()->jurusan == "SMK non Teknik" ?  "selected" : ""  ?> value="SMK non Teknik">SMK non Teknik</option>
                                                    </select>
                                                </fieldset>
                                                <label for="tahun_lulus">Tahun Lulus SMA</label>
                                                <fieldset class="form-group position-relative">
                                                    <input id="tahun_lulus" type="number" min="0" value="{{  Auth::user()->tahun_lulus }}" class="form-control" name="tahun_lulus" autocomplete="tahun_lulus" autofocus>

                                                    @error('tahun_lulus')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </fieldset>
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mt-2">
                                            <span class="font-small-3 text-muted">Dengan klik <b>Simpan</b>, kamu menyetujui Fispedia untuk mengolah dan menganalisis data yang kamu berikan.</span>
                                            <hr class="mt-0">
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-info btn-min-width text-center"><i class="ft-user"></i> Simpan</button>        
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
