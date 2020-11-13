@extends('layouts.app')

@section('content')
    @include('layouts.include')
    <body class="horizontal-layout horizontal-top-icon-menu 2-columns   menu-expanded" data-open="hover" data-menu="horizontal-menu" data-col="2-columns">

        <div class="app-content content">
          <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
             
    <!-- activity charts -->
    <div class="row">
        <div class="col-xl-8 col-lg-12 ">
            <div class="card">
                <div class="card-header no-border-bottom">
                    <div class="row ml-1 mr-1">
                        <h4 class="text-bold-400">TRY OUT UTBK 2021 PART 1</h4>
                    </div>
                </div>
                <hr>
                <div class="card-content">
                    <div class="card-body">
                        <div class="row ml-1 mr-1">
                            <span class="mb-1">Peraturan</span>
                            <li class="mr-2">
                                <span class="font-small-4 text-muted">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam blandit, enim at dictum auctor, mi sapien porttitor diam, a lacinia purus leo sed quam.</span></li>
                            <li class="mr-2">
                                <span class="font-small-4 text-muted">2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam blandit, enim at dictum auctor, mi sapien porttitor diam, a lacinia purus leo sed quam.</span></li>
                            <li class="mr-2">
                                <span class="font-small-4 text-muted">3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam blandit, enim at dictum auctor, mi sapien porttitor diam, a lacinia purus leo sed quam.</span></li>
                            <li class="mr-2">
                                <span class="font-small-4 text-muted">4. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam blandit, enim at dictum auctor, mi sapien porttitor diam, a lacinia purus leo sed quam.</span></li>

                            <span class="mt-1">Selamat Mengerjakan! :D</span>    
                        </div>
                        
                        <div class="height-100"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-12">
            <div class="card profile-card-with-cover">
                <div class="card-content text-center">
                    <div class="card-header">
                        <h4 class="text-bold-400">TES POTENSI SKOLASTIK</h4>
                    </div>
                    <div class="mb-2">
                        <div class="ml-2 mr-2 mb-3">
                            <div class="form-group">
                                <?php $i=1; ?>
                                <a href="tryout{{$data[0]->id_tryout}}/{{$i++}}/{{1}}" class="btn  btn-min-width mb-1 btn-outline-info btn-lg btn-block">PENALARAN UMUM </a>
                                <a href="tryout{{$data[0]->id_tryout}}/{{$i++}}/{{1}}" class="btn  btn-min-width mb-1 btn-outline-info btn-lg btn-block">PENGETAHUAN DAN PEMAHAMAN UMUM </a>
                                <a href="tryout{{$data[0]->id_tryout}}/{{$i++}}/{{1}}" class="btn  btn-min-width mb-1 btn-outline-info btn-lg btn-block">PEMAHAMAN BACAAN DAN MENULIS </a>
                                <a href="tryout{{$data[0]->id_tryout}}/{{$i++}}/{{1}}" class="btn  btn-min-width mb-1 btn-outline-info btn-lg btn-block">PENGETAHUAN KUANTITATIF </a>
                                <a href="tryout{{$data[0]->id_tryout}}/{{$i++}}/{{1}}" class="btn  btn-min-width mb-1 btn-outline-info btn-lg btn-block">BAHASA INGGRIS </a>
                            </div>
                        </div>
                        <hr>
                        @if (strtolower($data[0]->kelompok_ujian) == 'saintek')

                            <div class="card-header">
                                <h4 class="text-bold-400">TKA SAINTEK</h4>
                            </div>
                            <div class="ml-2 mr-2">
                                <div class="form-group">
                                    <a href="tryout{{$data[0]->id_tryout}}/{{$i++}}/{{1}}" class="btn  btn-min-width mb-1 btn-outline-info btn-lg btn-block">MATEMATIKA SAINTEK</a>
                                    <a href="tryout{{$data[0]->id_tryout}}/{{$i++}}/{{1}}" class="btn  btn-min-width mb-1 btn-outline-info btn-lg btn-block">FISIKA</a>
                                    <a href="tryout{{$data[0]->id_tryout}}/{{$i++}}/{{1}}" class="btn  btn-min-width mb-1 btn-outline-info btn-lg btn-block">KIMIA</a>
                                    <a href="tryout{{$data[0]->id_tryout}}/{{$i++}}/{{1}}" class="btn  btn-min-width mb-1 btn-outline-info btn-lg btn-block">BIOLOGI</a>
                                </div>
                            </div>
                        @else
                            <div class="card-header">
                                <h4 class="text-bold-400">TKA SOSHUM</h4>
                            </div>
                            <div class="ml-2 mr-2">
                                <div class="form-group">
                                    <a href="tryout{{$data[0]->id_tryout}}/{{$i++}}/{{1}}" class="btn  btn-min-width mb-1 btn-outline-info btn-lg btn-block">MATEMATIKA SOSHUM</a>
                                    <a href="tryout{{$data[0]->id_tryout}}/{{$i++}}/{{1}}" class="btn  btn-min-width mb-1 btn-outline-info btn-lg btn-block">EKONOMI</a>
                                    <a href="tryout{{$data[0]->id_tryout}}/{{$i++}}/{{1}}" class="btn  btn-min-width mb-1 btn-outline-info btn-lg btn-block">GEOGRAFI</a>
                                    <a href="tryout{{$data[0]->id_tryout}}/{{$i++}}/{{1}}" class="btn  btn-min-width mb-1 btn-outline-info btn-lg btn-block">SOSIOLOGI DAN SEJARAH</a>
                                </div>
                            </div>
                        @endif
                        <hr class="mt-3">
                        <button class="btn btn-danger btn-min-width">Selesai Ujian</button>
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
@endsection