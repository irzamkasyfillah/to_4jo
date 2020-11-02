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
                <div class="mt-2 mb-2">
                    <div class="ml-2 mr-2">
                        <div class="form-group">
                            <a href="list-to/{{'penalaran-umum'}}/{{1}}" class="btn  btn-min-width mb-1 btn-outline-info btn-lg btn-block">PENALARAN UMUM <i class="ft-arrow-right"></i></a>
                            <a href="list-to/{{'pengetahuan-dan-pemahaman-umum'}}/{{1}}" class="btn  btn-min-width mb-1 btn-outline-info btn-lg btn-block">PENGETAHUAN DAN PEMAHAMAN UMUM <i class="ft-arrow-right"></i></a>
                            <a href="list-to/{{'pemahaman-bacaan-dan-menulis'}}/{{1}}" class="btn  btn-min-width mb-1 btn-outline-info btn-lg btn-block">PEMAHAMAN BACAAN DAN MENULIS <i class="ft-arrow-right"></i></a>
                            <a href="list-to/{{'pengetahuan-kuantitatif'}}/{{1}}" class="btn  btn-min-width mb-1 btn-outline-info btn-lg btn-block">PENGETAHUAN KUANTITATIF <i class="ft-arrow-right"></i></a>
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
@endsection