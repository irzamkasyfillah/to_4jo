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
                                            <span class="text-bold-300">Daftar Peserta Telah Dikonfirmasi</span>
                                        </h3> 
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="data" class="table table-hover table-striped table-bordered zero-configuration">
                                            <thead>
                                                <tr class="" >
                                                    <th width="">No</th>
                                                    <th width="">Nama</th>
                                                    <th width="">Email</th>
                                                    <th width="">Tryout Terdaftar</th>
                                                    <th width="">Kelompok Ujian</th>
                                                    <th width="">Harga</th>
                                                    <th width="">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                @foreach ($data_peserta_dikonfirmasi as $data)
                                                <tr>
                                                    <td class="">{{$i++}}</td>
                                                    <td>{{ ucwords($data->name) }}</td>
                                                    <td>{{ $data->email }}</td>
                                                    <td>{{ ucwords($data->nama) }}</td>
                                                    <td>{{ $data->kelompok_ujian }} </td>
                                                    <td>Rp. {{ $data->harga }} </td>
                                                    <td>{{ $data->status }} </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr class="" >
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Tryout terdaftar</th>
                                                    <th>Kelompok Ujian</th>
                                                    <th>Harga</th>
                                                    <th>Status</th>
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
    