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
                                            <span class="text-bold-300">Edit Nilai Peserta <b>{{ucwords($data->nama)}}</b></strong></span>
                                        </h3> 
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input class="form-control" readonly name="nama" value="{{ ucwords($peserta[0]->name) }}" id="nama">
                                    </div>
                                    <div class="form-group">
                                        <label for="subtes">Subtes</label>
                                        <input class="form-control" readonly name="subtes" value="{{ $subtes->nama }}" id="subtes">
                                    </div>
                                    <form class="form" action="{{ route('update-nilai.update', [$data->id, $subtes->id, $peserta[0]->id ]) }}">
                                        <div class="form-group">
                                            <label for="nilai">Nilai</label>
                                            @if (count($nilai) > 0)
                                                <input required class="form-control" type="number" min="0" name="nilai" value="{{ $nilai[0]->nilai }}" id="nilai">
                                            @else
                                                <input class="form-control" type="number" min="0" name="nilai" value="" id="nilai">
                                            @endif
                                        </div>
                                        <div class="form-actions">
                                            <a href="{{route('history-try-out.index')}}" type="button" class="btn btn-warning mr-1">
                                                <i class="ft-x"></i> Cancel
                                            </a>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-check-square-o"></i> Save
                                            </button>
                                        </div>
                                    </form>
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
    