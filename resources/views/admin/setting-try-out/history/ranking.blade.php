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
                                            <span class="text-bold-300">Ranking <b>{{ $data_to->nama }}</b></span>
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
                                                    <th width="">Nama</th>
                                                    <th width="">Email</th>
                                                    <th width="">Kelompok Ujian</th>
                                                    <th width="">Rata-rata</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data_peserta as $data)
                                                    <tr>
                                                        <td>{{ $data->name}}</td>
                                                        <td>{{ $data->email}}</td>
                                                        <td>{{ $data->kelompok_ujian}}</td>
                                                        <?php $rata=0; ?>
                                                        @foreach ($data_nilai as $nilai)
                                                            @if ($nilai->id_peserta == $data->id_peserta)
                                                                <?php $rata += $nilai->nilai; ?>
                                                            @endif
                                                        @endforeach
                                                        <td>{{ round($rata/(count($data_subtes)-4), 2) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr class="">
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Kelompok Ujian</th>
                                                    <th>Rata-rata</th>
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
        <div class="height-200"></div>
    </div>

    @endif
@endsection
    