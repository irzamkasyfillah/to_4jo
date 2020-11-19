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
                                            <span class="text-bold-300">History Try Out</strong></span>
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
                                                <tr class="">
                                                    <th width="">Nama Try Out</th>
                                                    <th width="">Waktu</th>
                                                    <th width="">Jumlah Peserta</th>
                                                    <th width="10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 0; ?>
                                                @foreach ($data as $data)
                                                <tr>
                                                    <td><?php echo $data->nama ?></td>
                                                    <td><?php echo $data->waktu ?></td>
                                                    <td><?php echo $peserta[$i++] ?></td>
                                                    <td class="text-center">
                                                        <a data-toggle="tooltip" data-placement="top" title="Detail" href="{{route('history-try-out.show', $data->id)}}" class="btn btn-info"><i class="fa fa-pencil-square-o"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr class="">
                                                    <th>Nama Try Out</th>
                                                    <th>Waktu</th>
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
    