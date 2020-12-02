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
                                            <span class="text-bold-300">Data User</strong></span>
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
                                                    <th width="">Foto</th>
                                                    <th width="">Nama</th>
                                                    <th width="">Email</th>
                                                    <th width="">Tgl Lahir</th>
                                                    <th width="">HP</th>
                                                    <th width="">Instagram</th>
                                                    <th class="text-center" width="">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data_user as $data)
                                                <tr>
                                                    @if ($data->foto != null || $data->foto != "" )
                                                        <?php $src = '225_'.$data->foto ?>
                                                    @else
                                                        @if ($data->jenis_kelamin != "" || $data->jenis_kelamin != null )
                                                            @if (strtolower($data->jenis_kelamin) == "laki-laki")
                                                                <?php $src = "man-avatar-m.png" ?>
                                                            @else
                                                                <?php $src = "woman-avatar-m.png" ?>
                                                            @endif
                                                        @else
                                                            <?php $src = "man-avatar-m.png" ?>
                                                        @endif
                                                    @endif
                                                    <td class="text-center"><img src="{{ URL::to('/')}}/uploads/{{ $src }}" class="img-thumbnail" width="50%" alt="Foto"></td>
                                                    <td>{{ ucwords($data->name) }}</td>
                                                    <td>{{ $data->email }}</td>
                                                    <?php 
                                                        if ($data->tgl_lahir != "" || $data->tgl_lahir != null) {
                                                            $tgl_lahir = date_format(date_create($data->tgl_lahir), "d-m-Y");
                                                        } else {
                                                            $tgl_lahir = "";
                                                        }
                                                    ?>
                                                    <td>{{ $tgl_lahir }}</td>
                                                    <td>{{ $data->hp }}</td>
                                                    <td> {{ '@'.$data->instagram }}</td>
                                                    <td class="text-center">
                                                        <span data-toggle="modal" data-target="#detail{{$data->id}}">
                                                            <button data-toggle="tooltip" data-placement="top" title="Detail" href="{{ route('setting-waktu-pengerjaan-subtes.edit', $data->id) }}" class="btn btn-info"><i class="fa fa-info"></i></button>
                                                        </span>

                                                        {{-- MODAL DETAIL --}}
                                                        <div class="modal fade text-left" id="detail{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel1">Detail User {{ ucwords($data->name) }}</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h4 class="mb-1 text-center">Asal Sekolah</h4>
                                                                    <div class="table-responsive">
                                                                        <table class="table bg-transparent table-bordered table-striped">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td width="20%"><b>Provinsi</b></td>
                                                                                    <td>{{ $data->provinsi }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td width="20%"><b>Kota</b></td>
                                                                                    <td>{{ $data->kota }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td width="20%"><b>Nama Sekolah</b></td>
                                                                                    <td>{{ $data->nama_sekolah }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td width="20%"><b>Kelas</b></td>
                                                                                    <td>{{ $data->kelas }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td width="20%"><b>Jurusan</b></td>
                                                                                    <td>{{ $data->jurusan }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td width="20%"><b>Tahun Lulus</b></td>
                                                                                    <td>{{ $data->tahun_lulus }}</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
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
                                                    <th width="">Foto</th>
                                                    <th width="">Nama</th>
                                                    <th width="">Email</th>
                                                    <th width="">Tgl Lahir</th>
                                                    <th width="">HP</th>
                                                    <th width="">Instagram</th>
                                                    <th class="text-center" width="">Aksi</th>
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
    