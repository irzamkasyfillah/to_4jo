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
                    @if(!empty($errors->all())) 
                        @foreach($errors->all() as $error) 
                            <div class="alert alert-danger alert-block">
                                <span style="color:white;" class="text-bold-400">{{ $error }}</span>
                            </div>
                        @endforeach 
                    @endif
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header no-border-bottom">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <h3>
                                            <span class="text-bold-300">Setting Waktu Pengerjaan Tiap Subtes</strong></span>
                                        </h3> 
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="data" class="table table-hover table-striped table-bordered default-ordering">
                                            <thead>
                                                <tr class="">
                                                    <th width="40%">Subtes</th>
                                                    <th width="20%">Kategori</th>
                                                    <th width="10%">Jumlah Soal</th>
                                                    <th width="20%">Waktu Pengerjaan (Menit)</th>
                                                    <th class="text-center" width="10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $data)
                                                <tr>
                                                    <td>{{ $data->nama }}</td>
                                                    <td>{{ $data->kategori }}</td>
                                                    <td>{{ $data->jumlah_soal }}</td>
                                                    <td>{{ $data->durasi }}</td>
                                                    <td class="text-center">
                                                        <a data-toggle="tooltip" data-placement="top" title="Edit" href="{{ route('setting-waktu-pengerjaan-subtes.edit', $data->id) }}" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr class="text-center">
                                                    <th>Subtes</th>
                                                    <th>Kategori</th>
                                                    <th>Jumlah Soal</th>
                                                    <th>Waktu Pengerjaan (Menit)</th>
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
    