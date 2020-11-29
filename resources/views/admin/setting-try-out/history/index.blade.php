@extends('layouts.app')

@section('content')
    @if (Auth::user()->level == 'admin')
        @include('admin.include')


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
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header no-border-bottom">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <h3>
                                            <span class="text-bold-300">History Try Out</span>
                                        </h3> 
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="data" class="table table-hover table-striped table-bordered default-ordering">
                                            <thead class="bg-teal bg-lighten-4">
                                                <tr class="">
                                                    <th width="">Nama Try Out</th>
                                                    <th width="">Waktu</th>
                                                    <th width="">Harga</th>
                                                    <th width="">Jumlah Peserta</th>
                                                    <th width="">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 0; ?>
                                                @foreach ($data as $data)
                                                <tr>
                                                    <td><?php echo $data->nama ?></td>
                                                    <td class="text-center"><?php echo date_format(date_create($data->waktu), "l, j F Y - H:i") ?>
                                                        <br>- until -<br> <?php echo date_format(date_create($data->waktu_selesai), "l, j F Y - H:i") ?>
                                                    </td>
                                                    <td>Rp. <?php echo $data->harga ?></td>
                                                    <td><?php echo $peserta[$i++] ?></td>
                                                    <td class="text-center">
                                                        <div class="btn-group mr-1 mb-1">
                                                            <button type="button" class="btn btn-icon btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-info"></i></button>
                                                            <div class="dropdown-menu">
                                                                <button data-toggle="modal" data-target="#detail{{$data->id}}" class="dropdown-item"><i class="fa fa-book mr-1 ml-1"></i> List Soal</button>                                                        
                                                                <a href="{{route('show-nilai.show', [$data->id, 1, 0])}}" class="dropdown-item"><i class="fa fa-file-text-o mr-1 ml-1"></i> Rekap Nilai</a>
                                                                <a href="{{route('show-ranking.show', $data->id)}}" class="dropdown-item"><i class="fa fa-star mr-1 ml-1"></i> Ranking</a>
                                                                <a href="{{route('tryout.publish', $data->id)}}" class="dropdown-item"><i class="fa fa-share-square-o mr-1 ml-1"></i> Publish</a>
                                                            </div>
                                                        </div>

                                                        {{-- MODAL DETAIL --}}
                                                        <div class="modal fade text-left" id="detail{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel1">Detail Soal {{ $data->nama}}</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php
                                                                        $kategori = array('TPS', 'SAINTEK', 'SOSHUM');
                                                                        $warna = array('bg-success', 'bg-danger', 'bg-info');
                                                                        $i = 0;
                                                                    ?>
                                                                    @foreach ($kategori as $kategori)
                                                                        <h6 class=""><i class="fa fa-caret-right"></i> <b>{{ $kategori }}</b></h6>
                                                                        <hr>

                                                                        <div id="accordionWrap{{ $data->id }}" role="tablist" aria-multiselectable="true">
                                                                            <div class="card collapse-icon accordion-icon-rotate">
                                                                                @foreach ($data_subtes as $subtes)
                                                                                    @if ($subtes->kategori == $kategori)
                                                                                        <div id="heading{{ $subtes->id }}"  class="card-header {{ $warna[$i] }}" role="tab">
                                                                                            <a data-toggle="collapse" data-parent="#accordionWrap{{ $data->id }}" href="#subtes{{ $data->id . $subtes->id }}" aria-expanded="false"  class="card-title lead white">{{ $subtes->nama }}</a>
                                                                                        </div>
                                                                                        
                                                                                        <div id="subtes{{ $data->id . $subtes->id }}" role="tabpanel" aria-labelledby="heading{{ $data->id . $subtes->id }}" class="collapse">
                                                                                            <table class="table  bg-light table-striped table-bordered">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th width="5%">No.</th>
                                                                                                        <th class="text-center">Soal</th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <?php $no = 1; ?>
                                                                                                    @foreach ($data_soal as $soal)
                                                                                                        @if ($soal->subtes == $subtes->id)
                                                                                                            @foreach (str_split($data->soal) as $soal_check)
                                                                                                                @if ($soal->id == intval($soal_check))
                                                                                                                    <tr>
                                                                                                                        <td class="text-center">
                                                                                                                            {{$no++}}
                                                                                                                        </td>
                                                                                                                        <td>
                                                                                                                            <?php echo $soal->deskripsi ?>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                    <div class="pl-2 pr-2 pt-1 pb-1 {{ $warna[$i] }} white"> Jumlah soal : {{ $no-1}}</div>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                        <br>            
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        </div> 
                                                                    @endforeach 
                                                                </div>
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn white btn-secondary" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        {{-- END MODAL DETAIL --}}
                                                    </td>
                                                </tr>
                                                

                                                
                                                @endforeach
                                            </tbody>
                                            <tfoot class="bg-teal bg-lighten-4">
                                                <tr class="">
                                                    <th>Nama Try Out</th>
                                                    <th>Waktu</th>
                                                    <th>Harga</th>
                                                    <th>Jumlah Peserta</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="height-100"></div>
    </div>

    @endif
@endsection
    