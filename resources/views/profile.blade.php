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
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-12 border-right-grey border-right-lighten-3 clearfix">
                                            <form enctype="multipart/form-data" class="form-horizontal" method="POST" action="{{ route('profile.update', Auth::user()->id) }}">
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
                                                    <input id="jenis_kelamin" type="text" value="{{ Auth::user()->jenis_kelamin }}" class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" autocomplete="jenis kelamin">
                                                    @error('jenis_kelamin')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </fieldset>
                                                <label for="tgl_lahir">Tanggal Lahir</label>
                                                <fieldset class="form-group position-relative">
                                                    <input id="tgl_lahir" type="text" value="{{ Auth::user()->tgl_lahir }}"  class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir" autocomplete="tanggal lahir">
                                                    @error('tgl_lahir')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </fieldset>
                                                <label for="hp">No. HP</label>
                                                <fieldset class="form-group position-relative">
                                                    <input id="hp" type="number" value="{{ Auth::user()->hp }}"  class="form-control @error('hp') is-invalid @enderror" name="hp" autocomplete="No. HP">
                                                    @error('hp')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </fieldset>
                                                <label for="foto">Foto Profil</label><br>
                                                <img src="{{ URL::to('/')}}/uploads/{{ Auth::user()->foto }}" class="img-thumbnail" width="50%" alt="User Photo"><br><br>
                                                <div class="form-group position-relative">
                                                    <span>Ganti gambar?</span>
                                                    <input name="foto" type="file" class="@error('foto') is-invalid @enderror" id="foto">
                                                    @error('foto')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn btn-outline-info btn-block"><i class="ft-user"></i> Update Profile</button>
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
    </div>
</body>
@endsection
