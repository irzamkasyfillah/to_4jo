@extends('layouts.app')

@section('content')
   @guest
      @include('layouts.login')
   @else
   @if (Auth::user()->level == 'admin')
        @include('admin.include')
        @include('admin.home')
   @else
        @include('layouts.include')
        
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
         
<!-- activity charts -->
<div class="row">
    <div class="col-xl-8 col-lg-12">
        <div class="card">
            <div class="card-header no-border-bottom">
                <div class="row ml-1 mr-1">
                    <h4 class="text-bold-300">Dashboard</h4>
                </div>
            </div>
            <hr>

            <?php 
                $time = new DateTime();
                $time->setTimezone(new DateTimeZone('GMT+8'));    
                $now = $time->format('Y-m-d H:i:s');
            ?>

            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                        @foreach ($data_tryout as $data)
                            @if ($data->waktu < $now && $data->waktu_selesai > $now)
                                <div class="col mb-1 ml-1 mr-1">
                                    <div class="alert alert-warning alert-block">
                                        <button type="button" class="close" data-dismiss="alert">×</button> 
                                        <span style="color:white;" class="text-bold-400">
                                            {{ $data->nama }} sudah dimulai!. Batas Pengerjaan Try Out hingga {{date_format(date_create($data->waktu_selesai), "j F Y")}}, 
                                            pukul {{date_format(date_create($data->waktu_selesai), "H:i")}} WITA
                                        </span>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="row">
                    @foreach ($data_tryout as $data_tryout)
                        @if ($data->waktu < $now && $data->waktu_selesai > $now)
                            <?php $mulai = "Mulai / Daftar" ?>
                        @else
                            <?php $mulai = "Daftar" ?>
                        @endif
                        <a href="daftar-to/{{$data_tryout->id}}/{{Auth::user()->id}}" class="col-xl-5 ml-3 mb-3 border-grey border-lighten-3">
                            <div class="card-header border-2 text-center">
                                <span class="font-small-4 text-muted text-bold-400 "><b>{{strtoupper($data_tryout->nama)}}</b></span>
                            </div>
                            <span class="font-small-4 text-muted text-left">{{date_format(date_create($data_tryout->waktu), "j F Y")}} </span>
                            <hr>
                            <div class="card-content text-center">
                                <button type="button" class="btn btn-info round box-shadow-1 btn-min-width mr-1 mb-1">{{$mulai}}<i class="ft-arrow-right ml-1"></i></button>
                            </div>
                        </a>
                    @endforeach
                    </div>
                    <!-- <div id="weekly-activity-chart" class="height-250"></div> -->
                    <div class="height-300"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-12">
        <div class="card profile-card-with-cover">
          <div class="card-content">
            <div class="card-image text-center mt-2">
                @if (Auth::user()->foto != "" || Auth::user()->foto != null )
                    <?php $src = "225_".Auth::user()->foto ?>
                @else
                    @if (Auth::user()->jenis_kelamin != "" || Auth::user()->jenis_kelamin != null )
                        @if (strtolower(Auth::user()->jenis_kelamin) == "laki-laki")
                            <?php $src = "man-avatar-m.png" ?>
                        @else
                            <?php $src = "woman-avatar-m.png" ?>
                        @endif
                    @else
                        <?php $src = "man-avatar-m.png" ?>
                    @endif
                @endif
                <img src="{{ URL::to('/')}}/uploads/{{ $src }}" width="60%" class="rounded-circle img-border box-shadow-1" alt="Foto Profil">
            </div>
            <div class="col-12 mt-2">
                <h3 class="text-center m-2">{{ ucwords(Auth::user()->name) }}</h3>
                <hr class="m-2">
                <div class="ml-2 text-left">
                    <li class="mr-2 mb-1">
                        <i class="fa fa-envelope mr-1"></i>
                        <span class="font-small-4 text-muted">&nbsp;{{ Auth::user()->email }}</span>
                    </li>
                    <li class="mr-2 mb-1">
                        <i class="fa fa-graduation-cap mr-1"></i>
                        <span class="font-small-4 text-muted">{{ ucwords(Auth::user()->nama_sekolah) }}</span>
                    </li>
                    <li class="mr-2 mb-1">
                        <i class="fa fa-phone mr-1"></i>
                        <span class="font-small-4 text-muted">&nbsp;&nbsp;{{ Auth::user()->hp }}</span>
                    </li>
                    <li class="mr-2">
                        <i class="fa fa-instagram mr-1"></i>
                        <span class="font-small-4 text-muted">&nbsp;&nbsp;{{ Auth::user()->instagram }}</span>
                    </li>
                </div>
                <div class="card-body text-center">
                    <a href="{{ route('profile.index') }}" class="btn btn-info btn-lg btn-block"><i class="ft-user"></i> Edit Profile</a>
                </div>
            </div>
            </div>
          </div>
        </div>
      </div>


      <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-12 border-right-grey border-right-lighten-3 clearfix">
                        <div class="float-left pl-2">
                            <span class="grey darken-1 block">Age</span>
                            <span class="font-large-3 line-height-1 text-bold-300">25</span>
                        </div>
                        <div class="float-left mt-2">
                            <span class="grey darken-1 block">Years</span>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-12 border-right-grey border-right-lighten-3 clearfix">
                        <div class="float-left pl-2">
                            <span class="grey darken-1 block">Height</span>
                            <span class="font-large-3 line-height-1 text-bold-300">185</span>
                        </div>
                        <div class="float-left mt-2">
                            <span class="grey darken-1 block">cm</span>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-12 border-right-grey border-right-lighten-3 clearfix">
                        <div class="float-left pl-2">
                            <span class="grey darken-1 block">Weight</span>
                            <span class="font-large-3 line-height-1 text-bold-300">64</span>
                        </div>
                        <div class="float-left mt-2">
                            <span class="grey darken-1 block">Kg</span>
                            <span class="block"><i class="ft-arrow-down deep-orange accent-3"></i></span>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-12 clearfix">
                        <div class="float-left pl-2">
                            <span class="grey darken-1 block">Body mass index</span>
                            <span class="font-large-3 line-height-1 text-bold-300">22.3</span>
                        </div>
                        <div class="float-left mt-2">
                            <span class="grey darken-1 block">Kg/m</span>
                            <span class="block"><i class="ft-arrow-up success"></i></span>
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
      </div>
    </div>
    </div>
    @endif
    @endguest

@endsection
