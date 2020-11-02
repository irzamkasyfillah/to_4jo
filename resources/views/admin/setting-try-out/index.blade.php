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
                                                    <td>Rp. {{ $data->harga }}</td>
                                                    <td>
                                                    <!-- Icon Button dropdowns -->
                                                    <div class="btn-group mr-1 mb-1">
                                                        <button type="button" class="btn btn-icon btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-info"></i></button>
                                                        <div class="dropdown-menu">
                                                            <button class="dropdown-item" href="#" data-toggle="modal" data-target="#detail{{$data->id}}"><i class="fa mr-1 ml-1 fa-th-list"></i> Detail</button>
                                                            <a class="dropdown-item" href="{{ route('soal.edit',  $data->id) }}"><i class="ft-edit mr-1 ml-1"></i> Edit</a>
                                                            <button class="dropdown-item" href="#" data-toggle="modal" data-target="#hapus{{$data->id}}"><i class="ft-delete mr-1 ml-1"></i> Delete</button>
                                                        </div>
                                                    </div>
                                                    {{-- MODAL DETAIL --}}
                                                        <div class="modal fade text-left" id="detail{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                              <div class="modal-content">
                                                                <div class="modal-header">
                                                                  <h4 class="modal-title" id="myModalLabel1">Detail Soal {{ $data->nama }}</h4>
                                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                  </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <span class=""><i class="fa fa-caret-right mb-1"></i><b> TPS</b></span><br>
                                                                    <table style="background-color: white" class="table table-striped table-bordered text-left">
                                                                        <tr>
                                                                            <td>
                                                                                <span class="mb-1"><i class="fa fa-caret-right"></i><b> Penalaran Umum</b> ({{ count($soal_pu) }} soal)</span>
                                                                            </td>
                                                                        </tr>
                                                                        @foreach ($soal_pu as $soal)
                                                                        <tr>
                                                                            <td>    
                                                                                <span class="">{{ $soal->deskripsi }}</span>
                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                        <tr>
                                                                            <td>
                                                                                <span class="mb-1"><i class="fa fa-caret-right"></i> <b>Pemahaman Bacaan dan Menulis</b> ({{ count($soal_pbm) }} soal)</span>
                                                                            </td>
                                                                        </tr>
                                                                        @foreach ($soal_pbm as $soal)
                                                                        <tr>
                                                                            <td>
                                                                                <span class=""> {{ $soal->deskripsi }}</span>
                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                        <tr>
                                                                            <td>
                                                                                <span class="mb-1"><i class="fa fa-caret-right"></i> <b>Pengetahuan dan Pemahaman Umum</b> ({{ count($soal_ppu) }} soal)</span>
                                                                            </td>
                                                                        </tr>
                                                                        @foreach ($soal_ppu as $soal)
                                                                        <tr>
                                                                            <td>
                                                                                <span class=""> {{ $soal->deskripsi }}</span>
                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                        <tr>
                                                                            <td>
                                                                                <span class="mb-1"><i class="fa fa-caret-right"></i> <b>Pengetahuan Kuantitatif</b> ({{ count($soal_pk) }} soal)</span>
                                                                            </td>
                                                                        </tr>
                                                                        @foreach ($soal_pk as $soal)
                                                                        <tr>
                                                                            <td>
                                                                                <span class=""> {{ $soal->deskripsi }}</span>
                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                        <tr>
                                                                            <td>
                                                                                <span class="mb-1"><i class="fa fa-caret-right"></i> <b>Bahasa Inggris</b> ({{ count($soal_bi) }} soal)</span>
                                                                            </td>
                                                                        </tr>
                                                                        @foreach ($soal_bi as $soal)
                                                                        <tr>
                                                                            <td>
                                                                                <span class=""> {{ $soal->deskripsi }}</span>
                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </table>
                                                                    <hr>
                                                                    <span class=""><i class="fa fa-caret-right mb-1"></i><b> TKA SAINTEK</b></span><br>
                                                                    <table style="background-color: white" class="table table-striped table-bordered text-left">
                                                                        <tr>
                                                                            <td>
                                                                                <span class="mb-1"><i class="fa fa-caret-right"></i> <b>Matematika Saintek</b> ({{ count($soal_msa) }} soal)</span>
                                                                            </td>
                                                                        </tr>
                                                                        @foreach ($soal_msa as $soal)
                                                                        <tr>
                                                                            <td>    
                                                                                <span class="">{{ $soal->deskripsi }}</span>
                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                        <tr>
                                                                            <td>
                                                                                <span class="mb-1"><i class="fa fa-caret-right"></i> <b>Fisika</b> ({{ count($soal_f) }} soal)</span>
                                                                            </td>
                                                                        </tr>
                                                                        @foreach ($soal_f as $soal)
                                                                        <tr>
                                                                            <td>
                                                                                <span class=""> {{ $soal->deskripsi }}</span>
                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                        <tr>
                                                                            <td>
                                                                                <span class="mb-1"><i class="fa fa-caret-right"></i> <b>Kimia</b> ({{ count($soal_k) }} soal)</span>
                                                                            </td>
                                                                        </tr>
                                                                        @foreach ($soal_k as $soal)
                                                                        <tr>
                                                                            <td>
                                                                                <span class=""> {{ $soal->deskripsi }}</span>
                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                        <tr>
                                                                            <td>
                                                                                <span class="mb-1"><i class="fa fa-caret-right"></i> <b>Biologi</b> ({{ count($soal_b) }} soal)</span>
                                                                            </td>
                                                                        </tr>
                                                                        @foreach ($soal_b as $soal)
                                                                        <tr>
                                                                            <td>
                                                                                <span class=""> {{ $soal->deskripsi }}</span>
                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </table>
                                                                    <hr>
                                                                    <span class=""><i class="fa fa-caret-right mb-1"></i><b> TKA SOSHUM</b></span><br>
                                                                    <table style="background-color: white" class="table table-striped table-bordered text-left">
                                                                        <tr>
                                                                            <td>
                                                                                <span class="mb-1"><i class="fa fa-caret-right"></i> <b>MATEMATIKA SOSHUM</b> ({{ count($soal_mso) }} soal)</span>
                                                                            </td>
                                                                        </tr>
                                                                        @foreach ($soal_mso as $soal)
                                                                        <tr>
                                                                            <td>    
                                                                                <span class="">{{ $soal->deskripsi }}</span>
                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                        <tr>
                                                                            <td>
                                                                                <span class="mb-1"><i class="fa fa-caret-right"></i> <b>EKONOMI</b> ({{ count($soal_e) }} soal)</span>
                                                                            </td>
                                                                        </tr>
                                                                        @foreach ($soal_e as $soal)
                                                                        <tr>
                                                                            <td>
                                                                                <span class=""> {{ $soal->deskripsi }}</span>
                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                        <tr>
                                                                            <td>
                                                                                <span class="mb-1"><i class="fa fa-caret-right"></i> <b>GEOGRAFI</b> ({{ count($soal_g) }} soal)</span>
                                                                            </td>
                                                                        </tr>
                                                                        @foreach ($soal_g as $soal)
                                                                        <tr>
                                                                            <td>
                                                                                <span class=""> {{ $soal->deskripsi }}</span>
                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                        <tr>
                                                                            <td>
                                                                                <span class="mb-1"><i class="fa fa-caret-right"></i> <b>SOSIOLOGI DAN SEJARAH</b> ({{ count($soal_ss) }} soal)</span>
                                                                            </td>
                                                                        </tr>
                                                                        @foreach ($soal_ss as $soal)
                                                                        <tr>
                                                                            <td>
                                                                                <span class=""> {{ $soal->deskripsi }}</span>
                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
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
    