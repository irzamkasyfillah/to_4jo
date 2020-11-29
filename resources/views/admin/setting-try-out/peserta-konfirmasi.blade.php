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
                    @if ($message = Session::get('failed'))
                        <div class="col-xl-12">
                            <div class="alert alert-danger alert-block">
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
                                            <span class="text-bold-300">Daftar Konfirmasi Peserta Try Out</span>
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
                                                <tr class="" >
                                                    {{-- <th width="">No</th> --}}
                                                    <th width="">Nama</th>
                                                    <th width="">Email</th>
                                                    <th width="">Tryout Terdaftar</th>
                                                    <th width="">Klp Ujian</th>
                                                    <th width="">Harga</th>
                                                    <th width="">Status</th>
                                                    <th width="5%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                @foreach ($data_peserta_konfirmasi as $data)
                                                <tr>
                                                    {{-- <td class="">{{$i++}}</td> --}}
                                                    <td>{{ ucwords($data->name) }}</td>
                                                    <td>{{ $data->email }}</td>
                                                    <td>{{ ucwords($data->nama) }}</td>
                                                    <td>{{ $data->kelompok_ujian }} </td>
                                                    <td>Rp. {{ $data->harga }} </td>
                                                    <td>{{ $data->status }} </td>
                                                    <td class="text-center">
                                                        <form class="form" method="POST" action="../tryout/terima-peserta/{{$data->id_peserta_konfirmasi}}">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success btn-min-width mb-1"><i class="fa fa-check"></i> Terima</a>
                                                        </form>
                                                        <button data-toggle="modal" data-target="#tolak{{$data->id_peserta_konfirmasi}}" class="btn btn-danger btn-min-width"><i class="fa fa-times"></i> Tolak</button>
                                                    </td>
                                                </tr>

                                                 {{-- MODAL HAPUS --}}
                                                    <div class="modal fade text-left" id="tolak{{$data->id_peserta_konfirmasi}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel1">Tolak Peserta</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah Anda yakin ingin menolak peserta ini?</p>    
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                                                            <form class="form" method="POST" action="../tryout/tolak-peserta/{{$data->id_peserta_konfirmasi}}">
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger btn-min-width"><i class="fa fa-times"></i> Tolak</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                {{-- END MODAL HAPUS --}}
                                            @endforeach
                                            </tbody>
                                            <tfoot class="bg-teal bg-lighten-4">
                                                <tr class="" >
                                                    {{-- <th>No</th> --}}
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Tryout terdaftar</th>
                                                    <th>Klp Ujian</th>
                                                    <th>Harga</th>
                                                    <th>Status</th>
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
    