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
                                        <h3> {{strtoupper($data_tryout->nama)}}</h3>
                                    </div>
                                </div>
                                <hr class="mb-0">
                                <div class="card-content">
                                    <div class="card-body">
                                        <p class="mb-2">
                                            Untuk mendaftar di <b>{{ucfirst($data_tryout->nama)}}</b>, terlebih dahulu silakan pilih kelompok ujianmu.
                                            Kamu hanya dapat memilih <b>satu</b> kelompok ujian untuk setiap Try Out.
                                        </p>
                                        <form class="form-horizontal" method="POST" action="../../../daftar-to/{{$data_tryout->id}}/{{Auth::User()->id}}/transaksi">
                                            @csrf
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td width="" class="text-right">Try Out</td>
                                                    <td>{{$data_tryout->nama}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">Waktu</td>
                                                    <td>{{date_format(date_create($data_tryout->waktu), "j F Y - H:i")}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">Harga</td>
                                                    <td>Rp. <input type="number" id="harga" name="harga" value="{{$data_tryout->harga}}" readonly class=""></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">Masukkan Kupon</td>
                                                    <td><input type="text" id="kupon" name="kupon" class="form-control"><a id="cek_kupon" class="btn btn-warning white float-right mt-1">Cek kupon</a></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">Kelompok Ujian</td>
                                                    <td>
                                                        <select required  name="kelompok_ujian" class="form-control">
                                                            <option value="" selected="" disabled="">Pilih Kelompok</option>
                                                            <option value="SAINTEK">SAINTEK</option>
                                                            <option value="SOSHUM">SOSHUM</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </table>
                                            <div class="text-right mb-2">
                                                <span class="font-small-3 text-muted">Kelompok ujian yang sudah dipilih <b>tidak dapat diubah</b></span>
                                            </div>
                                            <div class="text-center mb-0">
                                                <button type="submit" class="btn btn-info btn-min-width"><i class="fa fa-check-square-o"></i> Daftar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    
                </div>
            </div>
            <div class="height-25"></div>
        </div>
@endsection