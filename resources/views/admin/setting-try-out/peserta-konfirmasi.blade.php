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
                                        <table id="data" class="table table-striped table-bordered zero-configuration">
                                            <thead>
                                                <tr class="text-center" >
                                                    <th width="5%">No</th>
                                                    <th width="">Email Peserta</th>
                                                    <th width="">Tryout Terdaftar</th>
                                                    <th width="">Kelompok Ujian</th>
                                                    <th width="">Harga</th>
                                                    <th width="">Status</th>
                                                    <th width="5%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                @foreach ($data_peserta_konfirmasi as $data)
                                                <tr>
                                                    <td class="text-center">{{$i++}}</td>
                                                    <td>{{ $data->email }}</td>
                                                    <td>{{ $data->nama }}</td>
                                                    <td>{{ $data->kelompok_ujian }} </td>
                                                    <td>Rp. {{ $data->harga }} </td>
                                                    <td>{{ $data->status }} </td>
                                                    <td class="text-center">
                                                        <form class="form" method="POST" action="../tryout/terima-peserta/{{$data->id_peserta_konfirmasi}}">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success btn-min-width mb-1"><i class="fa fa-check"></i> Terima</a>
                                                        </form>
                                                        <form class="form" method="POST" action="../tryout/tolak-peserta/{{$data->id_peserta_konfirmasi}}">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger btn-min-width"><i class="fa fa-times"></i> Tolak</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr class="text-center" >
                                                    <th>No</th>
                                                    <th>Email Peserta</th>
                                                    <th>Tryout terdaftar</th>
                                                    <th>Kelompok Ujian</th>
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
    