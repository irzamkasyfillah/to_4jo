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
                                        <h3>{{ $data->nama }}</h3>
                                    </div>
                                </div>
                                <hr class="mb-0">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="{{ route('tryout.login', [$data->id,Auth::user()->id]) }}" method="POST">
                                            @csrf
                                            @if ($message = Session::get('failed'))
                                                <div class="form-group">
                                                    <div class="alert alert-danger">
                                                        <button type="button" class="close" data-dismiss="alert">×</button> 
                                                        <span style="color:white;" class="text-bold-400">{{ strtoupper($message) }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <label for="kode_unik">Masukkan Kode</label>
                                                <input id="kode_unik" name="kode_unik" type="text" class="form-control">
                                            </div>
                                            
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-danger btn-min-width">Mulai</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="height-150"></div>
                    
                </div>
            </div>
            <div class="height-25"></div>
        </div>
@endsection