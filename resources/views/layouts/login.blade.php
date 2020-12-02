@section('css') @include('css.siswa') @endsection
@section('header') @include('layouts.header') @endsection

    
            
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header">
        </div>
        <div class="content-body">
            <div class="row match-height">
                <div class="col-xl-8 col-lg-12">
                    <div class="card">
                        <div class="card-header no-border-bottom">
                            <div class="row ml-1 mr-1">
                                <h4 class="text-bold-300">TRY OUT ONLINE</h4>
                            </div>
                        </div>
                        <hr>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                </div>
                                <!-- <div id="weekly-activity-chart" class="height-250"></div> -->
                                <div class="height-200"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-12">
                    <div class="card profile-card-with-cover">
                        <div class="card-content">
                            <div class="card-body">
                                <h3 class="text-center mb-2">LOGIN</h3>
                                <form method="POST" class="form-horizontal" action="{{ route('login') }}">
                                    @csrf
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input id="email" type="email" placeholder="Enter Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="form-control-position">
                                            <i class="ft-user"></i>
                                        </div>
                                    </fieldset>
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input id="password" type="password" placeholder="Enter Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="form-control-position">
                                            <i class="fa fa-key"></i>
                                        </div>
                                    </fieldset>
                                    <div class="form-group row">
                                        {{-- <div class="col-md-6 col-12 text-center text-sm-left">
                                            <fieldset>
                                                <input type="checkbox" id="remember-me" class="chk-remember">
                                                <label for="remember-me"> Remember Me</label>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6 col-12 float-sm-left text-center text-sm-right"><a href="recover-password.html" class="card-link">Forgot Password?</a></div> --}}
                                    </div>
                                    <button type="submit" class="btn btn-outline-info btn-block"><i class="ft-unlock"></i> Login</button>
                                    <!-- @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif -->
                                </form>
                            </div>
                            <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1"><span>Belum punya akun?</span></p>
                            <div class="card-body">
                                <a href="{{ route('register') }}" class="btn btn-outline-danger btn-block"><i class="ft-user"></i> Register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>      
        </div>
        <div class="height-200"></div>
    </div>
</div>