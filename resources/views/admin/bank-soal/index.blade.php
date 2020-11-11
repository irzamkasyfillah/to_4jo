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
                                            <span class="text-bold-300">Daftar Soal <strong>{{strtoupper($kategori)}}</strong></span>
                                        </h3> 
                                    </div>
                                    <div class="col-xl-6 text-right">
                                        <a href="{{ route('soal.create') }}" class="btn btn-info"><i class="ft-plus"></i> Tambah Soal</a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="data" class="table table-hover table-striped table-bordered zero-configuration">
                                            <thead>
                                                <tr>
                                                    <th width="20%">Subtes</th>
                                                    <th width="70%">Deskripsi</th>
                                                    <th width="10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $data)
                                                <tr>
                                                    <td>{{ $data->nama_subtes }}</td>
                                                    <td><?php echo $data->deskripsi ?> </td>
                                                    <td>
                                                    <!-- Icon Button dropdowns -->
                                                    <div class="btn-group mr-1 ">
                                                        <button type="button" class="btn btn-icon btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-info"></i></button>
                                                        <div class="dropdown-menu">
                                                            <button class="dropdown-item " href="#" data-toggle="modal" data-target="#detail{{$data->id_soal}}"><i class="fa fa-th-list mr-1 ml-1"></i> Detail </button>
                                                            <a class="dropdown-item btn " href="{{ route('soal.edit',  $data->id_soal) }}"><i class="ft-edit mr-1 ml-1"></i> Edit </a>
                                                            <button class="dropdown-item " href="#" data-toggle="modal" data-target="#hapus{{$data->id_soal}}"><i class="ft-delete mr-1 ml-1"></i> Delete </button>
                                                        </div>
                                                    </div>
                                                    {{-- MODAL DETAIL --}}
                                                        <div class="modal fade text-left" id="detail{{$data->id_soal}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                              <div class="modal-content">
                                                                <div class="modal-header">
                                                                  <h4 class="modal-title" id="myModalLabel1">Detail Soal</h4>
                                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                  </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <table style="background-color: white" class="table table-striped table-bordered">
                                                                        <tr>
                                                                            <td width="15%"><b>Soal</b></td>
                                                                            <td>
                                                                                <?php echo $data->deskripsi ?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><b>Opsi 1 (Benar)</b></td>
                                                                            <td>{{ $data->jawaban_benar }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><b>Opsi 2</b></td>
                                                                            <td>{{ $data->jawaban_salah_1 }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><b>Opsi 3</b></td>
                                                                            <td>{{ $data->jawaban_salah_2 }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><b>Opsi 4</b></td>
                                                                            <td>{{ $data->jawaban_salah_3 }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><b>Opsi 5</b></td>
                                                                            <td>{{ $data->jawaban_benar }}</td>
                                                                        </tr>
                                                                    </table>
                                                                  </div>
                                                                <div class="modal-footer">
                                                                  <button type="button" class="btn white btn-secondary" data-dismiss="modal">Close</button>
                                                                </div>
                                                              </div>
                                                            </div>
                                                        </div>
                                                        {{-- END MODAL DETAIL --}}

                                                        {{-- MODAL HAPUS --}}
                                                        <div class="modal fade text-left" id="hapus{{$data->id_soal}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                              <div class="modal-content">
                                                                <div class="modal-header">
                                                                  <h4 class="modal-title" id="myModalLabel1">Hapus Soal</h4>
                                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                  </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Yakin ingin hapus soal ini?</p>    
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                                                                    <form action="{{ route('soal.destroy', $data->id_soal)}}" method="POST">
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
                                                <tr>
                                                    <th>Subtes</th>
                                                    <th>Deskripsi</th>
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
    