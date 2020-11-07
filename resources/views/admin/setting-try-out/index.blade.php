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
                                            <span class="text-bold-300">Daftar Try Out</span>
                                        </h3> 
                                    </div>
                                    <div class="col-xl-6 text-right">
                                        <a href="{{ route('data-tryout.create') }}" class="btn btn-info"><i class="ft-plus"></i> Tambah Try Out</a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="data" class="table table-striped table-bordered zero-configuration">
                                            <thead>
                                                <tr class="text-center">
                                                    <th width="30%">Nama Try Out</th>
                                                    <th width="30%">Waktu (hari/tanggal/jam)</th>
                                                    <th width="30%">Harga</th>
                                                    <th width="10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data_tryout as $data)
                                                <tr class="">
                                                    <td>{{ $data->nama }}</td>
                                                    <td>
                                                        @if ($data->waktu != "")
                                                            {{ date_format(date_create($data->waktu), "l, j F Y - H:i:s") }}
                                                        @else
                                                            {{ "-" }}
                                                        @endif
                                                    </td>
                                                    <td>Rp. {{ $data->harga }} </td>
                                                    <td class="text-center">
                                                    <!-- Icon Button dropdowns -->
                                                    <div class="btn-group mr-1 mb-1">
                                                        <button type="button" class="btn btn-icon btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-info"></i></button>
                                                        <div class="dropdown-menu">
                                                            <button class="dropdown-item" href="#" data-toggle="modal" data-target="#detail{{$data->id}}"><i class="fa mr-1 ml-1 fa-th-list"></i> Detail</button>
                                                            <a class="dropdown-item" href="{{ route('data-tryout.edit',  $data->id) }}"><i class="ft-edit mr-1 ml-1"></i> Edit</a>
                                                            <button class="dropdown-item" href="#" data-toggle="modal" data-target="#hapus{{$data->id}}"><i class="ft-delete mr-1 ml-1"></i> Delete</button>
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
                                                                                        <table class="table bg-light table-striped table-bordered">
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
                                                                                                        @foreach ($data->soal as $soal_check)
                                                                                                            @if ($soal->id == intval($soal_check))
                                                                                                                <tr>
                                                                                                                    <td class="text-center">
                                                                                                                        {{$no++}}
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        {{$soal->deskripsi }}
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
                                                                    <?php $i++ ?>   
                                                                @endforeach 
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn white btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    {{-- END MODAL DETAIL --}}
                                                    

                                                        {{-- MODAL HAPUS --}}
                                                        <div class="modal fade text-left" id="hapus{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                              <div class="modal-content">
                                                                <div class="modal-header">
                                                                  <h4 class="modal-title" id="myModalLabel1">Hapus Data {{$data->nama}}</h4>
                                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                  </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Yakin ingin hapus data ini?</p>    
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                                                                    <form action="{{ route('data-tryout.destroy', $data->id)}}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                                    </form>
                                                                </div>
                                                              </div>
                                                            </div>
                                                        </div>
                                                        {{-- END MODAL HAPUS --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr class="text-center" >
                                                    <th>Nama Try Out</th>
                                                    <th>Waktu (hari/tanggal/jam)</th>
                                                    <th>Harga</th>
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
    