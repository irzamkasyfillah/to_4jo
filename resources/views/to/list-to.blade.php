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
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
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
                                    <div class="col-12">
                                        {{-- <h4 class="mb-1">Peraturan</h4> --}}
                                        <p>
                                            <?php echo $peraturan[0]->teks; ?>    
                                        </p>   
                                    </div>
                                    <div class="height-100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12">
                        <div class="card profile-card-with-cover">
                            <div class="card-content text-center">
                                <div class="card-header mb-1">
                                    <h4 class="text-bold-400">KATEGORI SOAL</h4>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <div class="ml-2 mr-2 mb-1">
                                        <div class="form-group">
                                            <?php 
                                                $subtes_done = $data[0]->subtes_done;
                                                $tps_check = "";
                                                $tps_disabled = "";
                                                $tps_btn = "info";
                                                $nothing_done = "disabled";
                                                if (strpos($subtes_done, '1') && strpos($subtes_done, '2') && strpos($subtes_done, '3') && strpos($subtes_done, '4') && strpos($subtes_done, '5')) {
                                                    $tps_check = "fa fa-check ml-1";
                                                    $tps_btn = "success";
                                                    $tps_disabled = "disabled";
                                                    $nothing_done = "";
                                                }
                                            ?>
                                                <button {{ $tps_disabled }} data-toggle="modal" data-target="#kerjatps" class="btn  btn-min-width mb-1 btn-{{ $tps_btn }} btn-lg btn-block">TES POTENSI SKOLASTIK <i class="{{ $tps_check }}"></i></button>

                                                {{-- MODAL KERJA TPS --}}
                                                <div class="modal fade text-left" id="kerjatps" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel1">TES POTENSI SKOLASTIK</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah Anda ingin mengerjakan kategori soal <b>TPS</b> ?<br><br>
                                                            Waktu pengerjaan soal akan dimulai begitu Anda klik tombol mulai.
                                                            </p>    
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-warning" data-dismiss="modal">BATAL</button>
                                                            <a href="../tryout{{$data[0]->id_tryout}}/1/{{1}}" class="btn btn-danger">MULAI</a>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                {{-- END MODAL KERJA TPS --}}
                                        </div>
                                    </div>
                                    @if (strtolower($data[0]->kelompok_ujian) == 'saintek')
                                        <div class="ml-2 mr-2">
                                            <div class="form-group">
                                                <?php 
                                                    $subtes_done = $data[0]->subtes_done;
                                                    $saintek_check = "";
                                                    $saintek_disabled = "";
                                                    $saintek_btn = "info";
                                                    if (strpos($subtes_done, '6') && strpos($subtes_done, '7') && strpos($subtes_done, '8') && strpos($subtes_done, '9')) {
                                                        $saintek_check = "fa fa-check ml-1";
                                                        $saintek_btn = "success";
                                                        $saintek_disabled = "disabled";
                                                    }
                                                ?>
                                                <button {{ $nothing_done }} {{ $saintek_disabled }} data-toggle="modal" data-target="#kerjasaintek" class="btn  btn-min-width mb-1 btn-{{$saintek_btn}} btn-lg btn-block">TKA SAINTEK <i class="{{$saintek_check}}"></i></button>

                                                {{-- MODAL KERJA SAINTEK --}}
                                                <div class="modal fade text-left" id="kerjasaintek" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel1">TKA SAINTEK</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah Anda ingin mengerjakan kategori soal <b>TKA SAINTEK</b> ?<br><br>
                                                            Waktu pengerjaan soal akan dimulai begitu Anda klik tombol mulai.
                                                            </p>    
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-warning" data-dismiss="modal">BATAL</button>
                                                            <a href="../tryout{{$data[0]->id_tryout}}/6/{{1}}" class="btn btn-danger">MULAI</a>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                {{-- END MODAL KERJA SAINTEK --}}
                                            </div>
                                        </div>
                                    @else
                                        <div class="ml-2 mr-2">
                                            <div class="form-group">
                                                <?php 
                                                    $subtes_done = $data[0]->subtes_done;
                                                    $soshum_check = "";
                                                    $soshum_disabled = "";
                                                    $soshum_btn = "info";
                                                    if (strpos($subtes_done, '10') && strpos($subtes_done, '11') && strpos($subtes_done, '12') && strpos($subtes_done, '13')) {
                                                        $soshum_check = "fa fa-check ml-1";
                                                        $soshum_btn = "success";
                                                        $soshum_disabled = "disabled";
                                                    }
                                                ?>
                                                <button {{ $nothing_done }} {{ $soshum_disabled }} data-toggle="modal" data-target="#kerjasoshum" class="btn  btn-min-width mb-1 btn-{{$soshum_btn}} btn-lg btn-block">TKA SOSHUM <i class="{{$soshum_check}}"></i></button>

                                                {{-- MODAL KERJA SOSHUM --}}
                                                <div class="modal fade text-left" id="kerjasoshum" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel1">TKA SOSHUM</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah Anda ingin mengerjakan kategori soal <b>TKA SOSHUM</b> ?<br><br>
                                                            Waktu pengerjaan soal akan dimulai begitu Anda klik tombol mulai.
                                                            </p>    
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-warning" data-dismiss="modal">BATAL</button>
                                                            <a href="../tryout{{$data[0]->id_tryout}}/10/{{1}}" class="btn btn-danger">MULAI</a>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                {{-- END MODAL KERJA SOSHUM --}}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                {{-- <div class="card-footer">
                                    <button data-toggle="modal" data-target="#selesai" class="btn btn-danger btn-min-width">SELESAI UJIAN</button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        {{-- MODAL HAPUS --}}
        {{-- <div class="modal fade text-left" id="selesai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
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
        </div> --}}
        {{-- END MODAL HAPUS --}}
@endsection