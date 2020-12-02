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
                                        <table id="data" class="table table-hover table-striped table-bordered default-ordering">
                                            <thead class="bg-teal bg-lighten-4">
                                                <tr class="">
                                                    <th width="">Nama</th>
                                                    <th width="">Waktu</th>
                                                    <th width="">Batas Pengerjaan</th>
                                                    <th width="">Harga</th>
                                                    <th width="">Jml Peserta Sementara</th>
                                                    <th width="">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $j=0; ?>
                                                @foreach ($data_tryout as $data)
                                                <tr class="">
                                                    <td>{{ $data->nama }}</td>
                                                    <td>
                                                        @if ($data->waktu != "")
                                                            {{ date_format(date_create($data->waktu), "l, j F Y - H:i") }}
                                                        @else
                                                            {{ "-" }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($data->waktu_selesai != "")
                                                            {{ date_format(date_create($data->waktu_selesai), "l, j F Y - H:i") }}
                                                        @else
                                                            {{ "-" }}
                                                        @endif
                                                    </td>
                                                    <td>Rp. {{ $data->harga }} </td>
                                                    <td>{{ $jml_peserta[$j++] }} </td>
                                                    <td class="text-center">
                                                        <!-- Icon Button dropdowns -->
                                                        <div class="btn-group mr-1 mb-1">
                                                            <button type="button" class="btn btn-icon btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-info"></i></button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="{{ route('data-tryout.show',  $data->id) }}" ><i class="fa mr-1 ml-1 fa-book"></i> List Soal</button>
                                                                <a class="dropdown-item" href="{{ route('data-tryout.edit',  $data->id) }}"><i class="ft-edit mr-1 ml-1"></i> Edit</a>
                                                                <button class="dropdown-item" href="#" data-toggle="modal" data-target="#hapus{{$data->id}}"><i class="ft-delete mr-1 ml-1"></i> Delete</button>
                                                            </div>
                                                        </div>
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
                                            <tfoot class="bg-teal bg-lighten-4">
                                                <tr class="" >
                                                    <th>Nama</th>
                                                    <th>Waktu</th>
                                                    <th>Batas Pengerjaan</th>
                                                    <th>Harga</th>
                                                    <th>Jml Peserta Sementara</th>
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
    