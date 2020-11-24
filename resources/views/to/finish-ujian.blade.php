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
                            <div class="mt-4 card border-grey border-lighten-3 py-1 col-md-5 col-10 box-shadow-2 p-0">
                                <div class="card-header border-0 pb-0">
                                    <div class="card-title text-center">
                                        <h3>{{ $data_to[0]->nama }}</h3>
                                    </div>
                                </div>
                                <hr class="mb-0">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <h4>
                                                Anda telah mengikuti ujian <b>{{$data_to[0]->nama}}</b>.
                                                Hasil ujian akan diberitahukan dalam beberapa hari kedepan. Terimakasih.
                                            </h4>
                                            <a href="{{ route('home') }}" class="mt-1 mb-1 btn btn-info btn-min-width">Kembali Ke Halaman Utama</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="height-200"></div>
                    
                </div>
            </div>
            <div class="height-25"></div>
        </div>
@endsection