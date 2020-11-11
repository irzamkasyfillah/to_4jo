@extends('layouts.app')

@section('content')
    @include('layouts.include')
        <div class="app-content content">
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <section class="flexbox-container">
                        <div class="col-12 d-flex align-items-center justify-content-center">
                            <div class="card border-grey border-lighten-3 py-1 col-md-5 col-10 box-shadow-2 p-0">
                                <div class="card-header border-0 pb-0">
                                    <div class="card-title text-center">
                                        <h3> Transaksi #{{$data_peserta[0]->id_peserta_konfirmasi}}</h3>
                                    </div>
                                </div>
                                <hr class="mb-0">
                                <div class="card-content">
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td width="" class="text-right">Email</td>
                                                <td>{{$data_peserta[0]->email}}</td>
                                            </tr>
                                            <tr>
                                                <td width="" class="text-right">Try Out</td>
                                                <td>{{$data_peserta[0]->nama}}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Waktu</td>
                                                <td>{{date_format(date_create($data_peserta[0]->waktu), "j F Y - H:i")}}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Harga</td>
                                                <td>Rp. {{$data_peserta[0]->harga}}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Kelompok Ujian</td>
                                                <td>{{$data_peserta[0]->kelompok_ujian}}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Status</td>
                                                <td><i class="fa fa-caret-right"></i> {{$data_peserta[0]->status}}</td>
                                            </tr>
                                        </table>
                                        @if (strtolower($data_peserta[0]->status) == "diterima")
                                            <div class="alert alert-success text-center mb-1">
                                                <span class="font-small-4 ">
                                                    Anda telah terdaftar dalam <b>{{$data_peserta[0]->nama}}</b>. Silakan cek pesan anda untuk info yang lebih detail. Terimakasih.
                                                </span>
                                            </div>
                                        @elseif (strtolower($data_peserta[0]->status) == "ditolak")
                                            <div class="alert alert-danger mb-1">
                                                <span class="font-small-4 ">
                                                    Maaf, anda telah ditolak untuk menjadi peserta <b>{{$data_peserta[0]->nama}}</b> karena alasan tertentu. Silakan lakukan pendaftaran ulang jika anda tetap ingin mendaftar sebagai peserta try out ini. Terimakasih.
                                                </span>
                                            </div>
                                        @else 
                                            <div class="text-center">
                                                <a href="javascript:location.reload();" class="btn btn-info btn-min-width mb-1 mr-1">Cek Status</a>
                                                <a data-toggle="modal" data-target="#hapus" href="" class="btn btn-danger btn-min-width mb-1">Batal Transaksi</a>
                                            </div>

                                            <h4 class="mb-1">Metode Pembayaran</h4>
                                            
                                            <li><span class="font-small-4 text-muted"><i class="fa fa-caret-right"></i> ipsum dolor sit amet, consectetur adipiscing elit. Vivamus pretium tincidunt turpis. Nullam at mattis nulla, ac venenatis leo. Sed nec ante sit amet tellus lobortis faucibus at quis enim.</span</li>
                                            <li><span class="font-small-4 text-muted"><i class="fa fa-caret-right"></i> ipsum dolor sit amet, consectetur adipiscing elit. Vivamus pretium tincidunt turpis. Nullam at mattis nulla, ac venenatis leo. Sed nec ante sit amet tellus lobortis faucibus at quis enim.</span</li>
                                            <li><span class="font-small-4 text-muted"><i class="fa fa-caret-right"></i> ipsum dolor sit amet, consectetur adipiscing elit. Vivamus pretium tincidunt turpis. Nullam at mattis nulla, ac venenatis leo. Sed nec ante sit amet tellus lobortis faucibus at quis enim.</span</li>
                                        @endif

                                        {{-- MODAL HAPUS --}}
                                        <div class="modal fade text-left" id="hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h4 class="modal-title" id="myModalLabel1">Batal Transaksi</h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda yakin ingin membatalkan transaksi ini?</p>    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Tidak</button>
                                                    <form action="../../transaksi/{{$data_peserta[0]->id_peserta_konfirmasi}}/delete" method="GET">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Ya</button>
                                                    </form>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                        {{-- END MODAL HAPUS --}}
                                </div>
                            </div>
                        </div>
                    </section>
                    
                </div>
            </div>
            <div class="height-25"></div>
        </div>
@endsection