@extends('layouts.app')

@section('content')
    @include('layouts.include')
        <div class="app-content content">
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <div class="row">
                        <div class="col-xl-9 col-lg-12 ">
                            <div class="card">
                                <div class="card-header no-border-bottom ml-1 mr-1">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <h4 class="text-bold-400">{{$data_soal[0]->nama}}</h4>    
                                            <h4 class="text-bold-400">SOAL NO. {{$no}}</h4>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="text-right">
                                                <h4 class="text-bold-400">SISA WAKTU</h4>
                                                <h4 class="text-bold-400">01:30:30</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row ml-1 mr-1">
                                            <span class="font-medium-2 mb-1"><?php echo $data_soal[$no-1]->deskripsi ?></span>
                                        </div>
                                        <hr class="ml-1 mr-1">
                                        <div class="row skin skin-square">
                                            <div class="col-12 ml-1 mr-1 mt-1">
                                                <?php 
                                                    $opsi = array('A','B','C','D','E');
                                                    $i = 0;
                                                ?>
                                                {{-- {{dd($data_jawaban_peserta)}} --}}
                                                @foreach ($data_jawaban as $jawaban)
                                                    @if (count($data_jawaban_peserta)>0)
                                                        @if ($jawaban->id == intval($data_jawaban_peserta[0]->id_jawaban))
                                                            <?php $checked = 'checked' ?>
                                                        @else
                                                            <?php $checked = '' ?>
                                                        @endif
                                                    @else
                                                        <?php $checked = '' ?>
                                                    @endif
                                                    {{-- <span class="mr-1"><b>{{$opsi[$i++]}}</b></span> --}}
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <input {{$checked}} onclick="insertJawaban('{{session()->get('loginTO')['id_peserta']}}', '{{$data_soal[$no-1]->id}}', '{{$jawaban->id}}')" type="radio" name="jawaban[]" id="input-radio">
                                                            <span class="row ml-1 mr-2 mb-1" style="margin-top : -4px;"><?php echo $jawaban->teks ?></span>
                                                        </div>
                                                    </div>

                                                @endforeach
                                            </div>
                                        </div>
                                        {{-- <div class="height-100"></div> --}}
                                    </div>
                                </div>
                                <hr>
                            
                                <div class="row ml-1 mr-1  mb-1">
                                    
                                    <div class="col-5">
                                        <div class="text-left">
                                        @if ($no > 1)
                                            <a href="../../tryout{{$data_tryout[0]->id}}/{{$data_soal[0]->subtes}}/{{$no-1}}" class="btn btn-info btn-min-width"><i class="ft-arrow-left"></i> Soal Sebelumnya</a>
                                        @else
                                            <a href="" class="disabled btn btn-info btn-min-width"><i class="ft-arrow-left"></i> Soal Sebelumnya</a>
                                        @endif
                                        </div>
                                    </div>
                                    
                                    @if (count($array_jawaban_ragu) > 0)
                                        @if (in_array($data_soal[$no-1]->id, $array_jawaban_ragu))
                                            <?php $ragu = 'checked'; ?>
                                        @else 
                                            <?php $ragu = ''; ?>
                                        @endif
                                    @else
                                        <?php $ragu = ''; ?>
                                    @endif

                                    <div class="col-2">
                                        <div class="text-center">
                                            <div class="bg-warning p-1 rounded white">
                                                <input {{$ragu}} class="" type="checkbox" id="keraguan"> Ragu-Ragu
                                                <input type="hidden" id="id_peserta" value="{{session()->get('loginTO')['id_peserta']}}">
                                                <input type="hidden" id="id_soal" value="{{$data_soal[$no-1]->id}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="text-right">
                                            @if ($no < count($data_soal))
                                                <a href="../../tryout{{$data_tryout[0]->id}}/{{$data_soal[0]->subtes}}/{{$no+1}}" class="btn btn-info btn-min-width">Soal Selanjutnya <i class="ft-arrow-right"></i></a>
                                            @else
                                                <a href="" class="disabled btn btn-info btn-min-width">Soal Selanjutnya <i class="ft-arrow-right"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-12">
                            <div class="card profile-card-with-cover">
                                <div class="card-content">
                                    <div class="col-12 text-center mt-2 mb-2">
                                        <h4 class="text-bold-400">NOMOR SOAL</h4>
                                    </div>
                                    <hr>
                                    <div class="card-body">
                                        <div class="row ml-1">

                                            @for ($i=1; $i<=count($data_soal); $i++)
                                                @if (in_array($data_soal[$i-1]->id, $array_jawaban))
                                                    @if (in_array($data_soal[$i-1]->id, $array_jawaban_ragu))
                                                        <?php $btn = 'btn-warning' ?>
                                                    @else
                                                        <?php $btn = 'btn-success' ?>
                                                    @endif
                                                @elseif (in_array($data_soal[$i-1]->id, $array_jawaban_ragu))
                                                    <?php $btn = 'btn-warning' ?>
                                                @else
                                                    <?php $btn = 'btn-secondary' ?>
                                                @endif
                                                <a href="../../tryout{{$data_tryout[0]->id}}/{{$data_soal[0]->subtes}}/{{$i}}"  style="min-width:46px; height:46px"class="btn mb-1 mr-1 {{$btn}}">{{$i}}</a>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="col-12 ml-1 mb-1">
                                        <span style="min-width:80px;" class="btn btn-success font-small-4">Hijau</span><span class="ml-1 font-small-4">= Sudah dijawab</span>
                                    </div>
                                    <div class="col-12 ml-1 mb-1">
                                        <span style="min-width:80px;" class="btn btn-warning font-small-4">Kuning</span><span class="ml-1 font-small-4">= Ragu-ragu</span>
                                    </div>
                                    <div class="col-12 ml-1">
                                        <span style="min-width:80px;" class="btn btn-secondary font-small-4">Hitam</span><span class="ml-1 font-small-4">= Belum dijawab</span>
                                    </div>
                                    <hr>
                                    <div class="form-group text-center mt-1">
                                        <button data-toggle="modal" data-target="#selesai" class="btn btn-danger">SELESAI</button>
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
                  <h4 class="modal-title" id="myModalLabel1">Selesai</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda telah selesai mengerjakan paket soal ini?<br><br>
                        *Aksi ini tidak dapat dibatalkan
                    </p>    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                    <form action="{{ route('subtes.finish', [$data_tryout[0]->id, $data_soal[0]->subtes, session()->get('loginTO')['id']]) }}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-danger">Selesai</button>
                    </form>
                </div>
              </div>
            </div>
        </div>
        {{-- END MODAL HAPUS --}}

        <script>
            function insertJawaban(id_peserta, id_soal, id_jawaban) {
                console.log(id_peserta, id_soal, id_jawaban)
                $.ajax({
                    url: '../../insert-jawaban/'+id_peserta+'/'+id_soal+'/'+id_jawaban,
                    success: function(data){
                        console.log(data);
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
            }

            $('#keraguan').change(function() {
                var id_peserta = $('#id_peserta').val();
                var id_soal = $('#id_soal').val();
                var ragu = 0;
                if  (this.checked) {
                   ragu = 1; 
                } 
                $.ajax({
                    url: '../../insert-ragu/'+id_peserta+'/'+id_soal+'/'+ragu,
                    success: function(data){
                        console.log(data);
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
            });
        </script>
@endsection


