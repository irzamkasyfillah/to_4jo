@extends('layouts.app')

@section('content')
   @guest
      @include('layouts.login')
   @else
   @if (Auth::user()->level == 'admin')
        @include('admin.include')
        @include('admin.home')
   @else
        @include('layouts.include')
        
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
         
<!-- activity charts -->
<div class="row match-height">
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header no-border-bottom">
                <div class="row ml-1 mr-1">
                    <h4 class="text-bold-300">Pesan</h4>
                </div>
            </div>
            <hr>
            <div class="card-content">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered zero-configuration">
                            <thead>
                                <th>Pengirim</th>
                                <th>Judul</th>
                                <th>Tanggal Terima</th>
                            </thead>
                            <tbody>
                                @foreach ($data as $data)
                                @if ($data->read == false) 
                                    <?php $bg = "bg-yellow";?>
                                @else
                                    <?php $bg = "";?>
                                @endif
                                <tr class="{{$bg}}">
                                    <td ><a href="../../notifikasi/detail/{{$data->id_notifikasi}}">{{$data->pengirim}}</a></td>
                                    <td ><a href="../../notifikasi/detail/{{$data->id_notifikasi}}">{{$data->judul}}</a></td>
                                    <td >{{date_format(date_create($data->created_at), 'd-m-Y')}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="height-300"></div>
                </div>
            </div>
        </div>
    </div>    
</div>
      
    </div>

        </div>
      </div>
    </div>
    </div>
    @endif
    @endguest

@endsection
