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
                                            <span class="text-bold-300">Daftar Kupon</strong></span>
                                        </h3> 
                                    </div>
                                    <div class="col-xl-6 text-right">
                                        <a href="{{ route('kupon.create') }}" class="btn btn-info"><i class="ft-plus"></i> Tambah Kupon</a>
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
                                                    <th width="30%">Kode Kupon</th>
                                                    <th width="45%">Try Out</th>
                                                    <th width="10%">Persen (%)</th>
                                                    <th width="15%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data_kupon as $data)
                                                <tr>
                                                    <td>{{ $data->kode_kupon }}</td>
                                                    <td>{{ $data->nama }}</td>
                                                    <td>{{ $data->persen }}</td>
                                                    <td class="text-center">
                                                        <a data-toggle="tooltip" data-placement="top" title="Edit" href="{{route('kupon.edit', $data->id)}}" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i></a>
                                                        <span data-toggle="modal" data-target="#hapus{{$data->id}}">
                                                            <button data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                        </span>

                                                        {{-- MODAL HAPUS --}}
                                                        <div class="modal fade text-left" id="hapus{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                              <div class="modal-content">
                                                                <div class="modal-header">
                                                                  <h4 class="modal-title" id="myModalLabel1">Hapus Kupon</h4>
                                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                  </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Yakin ingin hapus kupon ini?</p>    
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                                                                    <form action="{{ route('kupon.destroy', $data->id)}}" method="POST">
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
                                                <tr class="">
                                                    <th>Kode Kupon</th>
                                                    <th>Try Out</th>
                                                    <th>Persen (%)</th>
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
    