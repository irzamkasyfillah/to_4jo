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
                                            <span class="text-bold-300">Daftar Try Out</span>
                                        </h3> 
                                    </div>
                                    <div class="col-xl-6 text-right">
                                        <a href="{{ route('data-tryout.create') }}" class="btn btn-info"><i class="ft-plus"></i> Tambah Try Out</a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="data" class="table table-striped table-bordered zero-configuration">
                                            <thead>
                                                <tr>
                                                    <th width="30%">Nama Try Out</th>
                                                    <th width="30%">Waktu (hari/tanggal/jam)</th>
                                                    <th width="30%">Harga</th>
                                                    <th width="10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data_tryout as $data)
                                                <tr>
                                                    <td>{{ $data->nama }}</td>
                                                    <td>{{ date_format(date_create($data->waktu), "l, j F Y - H:i:s") }}</td>
                                                    <td>Rp. 
                                                        {{-- {{ dd($data) }} --}}
                                                        @foreach ($data->soal as $soal)
                                                            {{$soal . ", "}}
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                    <!-- Icon Button dropdowns -->
                                                    <div class="btn-group mr-1 mb-1">
                                                        <button type="button" class="btn btn-icon btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-info"></i></button>
                                                        <div class="dropdown-menu">
                                                            <button class="dropdown-item" href="#" data-toggle="modal" data-target="#detail{{$data->id}}"><i class="fa mr-1 ml-1 fa-th-list"></i> Detail</button>
                                                            <a class="dropdown-item" href="{{ route('data-tryout.edit',  $data->id) }}"><i class="ft-edit mr-1 ml-1"></i> Edit</a>
                                                            <button class="dropdown-item" href="#" data-toggle="modal" data-target="#hapus{{$data->id}}"><i class="ft-delete mr-1 ml-1"></i> Delete</button>
                                                        </div>
                                                    </div>
                                                    

                                                        {{-- MODAL HAPUS --}}
                                                        <div class="modal fade text-left" id="hapus{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                              <div class="modal-content">
                                                                <div class="modal-header">
                                                                  <h4 class="modal-title" id="myModalLabel1">Hapus Try Out</h4>
                                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                  </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Yakin ingin hapus data ini?</p>    
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                                                                    <form action="{{ route('data-tryout.destroy', $data->id)}}" method="POST">
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
                                                    <th>Nama Try Out</th>
                                                    <th>Waktu (hari/tanggal/jam)</th>
                                                    <th>Harga</th>
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

    {{-- MODAL DETAIL --}}
    <div class="modal fade text-left" id="detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel1">Detail Soal </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <h3>TPS</h3>
                <div id="accordionWrapa1" role="tablist" aria-multiselectable="true">
                    <div class="card">
                        <div id="heading1"  class="card-header" role="tab">
                            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#tps1" aria-expanded="false"  class="card-title lead">Penalaran Umum</a>
                        </div>
                        <div id="tps1" role="tabpanel" aria-labelledby="heading1" class="collapse show">
                            <div class="card-content">
                                <div class="card-body">
                                    Caramels dessert chocolate cake pastry jujubes bonbon. Jelly wafer jelly beans. Caramels chocolate cake liquorice cake wafer jelly beans croissant apple pie. Oat cake brownie pudding jelly beans. Wafer liquorice chocolate bar chocolate bar liquorice. Tootsie roll gingerbread gingerbread chocolate bar tart chupa chups sugar plum toffee. Carrot cake macaroon sweet danish. Cupcake soufflé toffee marzipan candy canes pie jelly-o. Cotton candy bonbon powder topping carrot cake cookie caramels lemon drops liquorice. Dessert cookie ice cream toffee apple pie.
                                </div>
                            </div>
                        </div>

                        <div id="heading2"  class="card-header" role="tab">
                            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#tps2" aria-expanded="false"  class="card-title lead">Pemahaman Bacaan dan Menulis</a>
                        </div>
                        <div id="tps2" role="tabpanel" aria-labelledby="heading1" class="collapse show">
                            <div class="card-content">
                                <div class="card-body">
                                    Caramels dessert chocolate cake pastry jujubes bonbon. Jelly wafer jelly beans. Caramels chocolate cake liquorice cake wafer jelly beans croissant apple pie. Oat cake brownie pudding jelly beans. Wafer liquorice chocolate bar chocolate bar liquorice. Tootsie roll gingerbread gingerbread chocolate bar tart chupa chups sugar plum toffee. Carrot cake macaroon sweet danish. Cupcake soufflé toffee marzipan candy canes pie jelly-o. Cotton candy bonbon powder topping carrot cake cookie caramels lemon drops liquorice. Dessert cookie ice cream toffee apple pie.
                                </div>
                            </div>
                        </div>

                        <div id="heading1"  class="card-header" role="tab">
                            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion1" aria-expanded="false"  class="card-title lead">Accordion Group Item #1</a>
                        </div>
                        <div id="accordion1" role="tabpanel" aria-labelledby="heading1" class="collapse show">
                            <div class="card-content">
                                <div class="card-body">
                                    Caramels dessert chocolate cake pastry jujubes bonbon. Jelly wafer jelly beans. Caramels chocolate cake liquorice cake wafer jelly beans croissant apple pie. Oat cake brownie pudding jelly beans. Wafer liquorice chocolate bar chocolate bar liquorice. Tootsie roll gingerbread gingerbread chocolate bar tart chupa chups sugar plum toffee. Carrot cake macaroon sweet danish. Cupcake soufflé toffee marzipan candy canes pie jelly-o. Cotton candy bonbon powder topping carrot cake cookie caramels lemon drops liquorice. Dessert cookie ice cream toffee apple pie.
                                </div>
                            </div>
                        </div>

                        <div id="heading1"  class="card-header" role="tab">
                            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion1" aria-expanded="false"  class="card-title lead">Accordion Group Item #1</a>
                        </div>
                        <div id="accordion1" role="tabpanel" aria-labelledby="heading1" class="collapse show">
                            <div class="card-content">
                                <div class="card-body">
                                    Caramels dessert chocolate cake pastry jujubes bonbon. Jelly wafer jelly beans. Caramels chocolate cake liquorice cake wafer jelly beans croissant apple pie. Oat cake brownie pudding jelly beans. Wafer liquorice chocolate bar chocolate bar liquorice. Tootsie roll gingerbread gingerbread chocolate bar tart chupa chups sugar plum toffee. Carrot cake macaroon sweet danish. Cupcake soufflé toffee marzipan candy canes pie jelly-o. Cotton candy bonbon powder topping carrot cake cookie caramels lemon drops liquorice. Dessert cookie ice cream toffee apple pie.
                                </div>
                            </div>
                        </div>

                        <div id="heading1"  class="card-header" role="tab">
                            <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion1" aria-expanded="false"  class="card-title lead">Accordion Group Item #1</a>
                        </div>
                        <div id="accordion1" role="tabpanel" aria-labelledby="heading1" class="collapse show">
                            <div class="card-content">
                                <div class="card-body">
                                    Caramels dessert chocolate cake pastry jujubes bonbon. Jelly wafer jelly beans. Caramels chocolate cake liquorice cake wafer jelly beans croissant apple pie. Oat cake brownie pudding jelly beans. Wafer liquorice chocolate bar chocolate bar liquorice. Tootsie roll gingerbread gingerbread chocolate bar tart chupa chups sugar plum toffee. Carrot cake macaroon sweet danish. Cupcake soufflé toffee marzipan candy canes pie jelly-o. Cotton candy bonbon powder topping carrot cake cookie caramels lemon drops liquorice. Dessert cookie ice cream toffee apple pie.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn white btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>
    {{-- END MODAL DETAIL --}}

    <script>
        $('#kategori').click(function(){

        });
    </script>

    @endif
@endsection
    