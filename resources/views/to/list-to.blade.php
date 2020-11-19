@extends('layouts.app')

@section('content')
    @include('layouts.include')
        <div class="app-content content">
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-xl-8 col-lg-12 ">
                        @if ($message = Session::get('failed'))
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button> 
                                <span style="color:white;" class="text-bold-400">{{ strtoupper($message) }}</span>
                            </div>
                        @endif
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
                                            @foreach ($tps as $tps)
                                                <a href="tryout{{$data[0]->id_tryout}}/{{$tps->id}}/{{1}}" class="btn  btn-min-width mb-1 btn-outline-info btn-lg btn-block">{{$tps->nama}} </a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <hr>
                                    @if (strtolower($data[0]->kelompok_ujian) == 'saintek')

                                        <div class="card-header">
                                            <h4 class="text-bold-400">TKA SAINTEK</h4>
                                        </div>
                                        <div class="ml-2 mr-2">
                                            <div class="form-group">
                                                @foreach ($saintek as $saintek)
                                                    <a href="tryout{{$data[0]->id_tryout}}/{{$saintek->id}}/{{1}}" class="btn  btn-min-width mb-1 btn-outline-info btn-lg btn-block">{{$saintek->nama}}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <div class="card-header">
                                            <h4 class="text-bold-400">TKA SOSHUM</h4>
                                        </div>
                                        <div class="ml-2 mr-2">
                                            <div class="form-group">
                                                @foreach ($soshum as $soshum)
                                                    <a href="tryout{{$data[0]->id_tryout}}/{{$soshum->id}}/{{1}}" class="btn  btn-min-width mb-1 btn-outline-info btn-lg btn-block">{{$soshum->nama}}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    <hr class="mt-3">
                                    <button data-toggle="modal" data-target="#selesai" class="btn btn-danger btn-min-width">SELESAI UJIAN</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        {{-- MODAL HAPUS --}}
        <div class="modal fade text-left" id="selesai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel1">SELESAI</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda telah menyelesaikan seluruh paket soal?<br><br>
                        *Aksi ini tidak dapat dibatalkan
                    </p>    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                    <a href="{{ route('ujian.finish', [$data[0]->id_tryout, session()->get('loginTO')['id']]) }}" class="btn btn-danger">Selesai</a>
                </div>
              </div>
            </div>
        </div>
        {{-- END MODAL HAPUS --}}
@endsection