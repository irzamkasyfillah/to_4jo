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
                    <h4 class="text-bold-300">Detail Pesan</h4>
                </div>
            </div>
            <hr>
            <div class="card-content">
                <div class="card-body">
                    {{-- <div class="row"> --}}
                        <table class="table table-striped table-borderless">
                            <tbody>
                                @foreach ($data as $data)
                                <tr>
                                    <td class="text-right"><b>Pengirim</b></td>
                                    <td>{{$data->pengirim}}</td>
                                </tr>
                                <tr>
                                    <td class="text-right"><b>Kepada</b></td>
                                    <td>{{ucwords($data->name)}}</td>
                                </tr>
                                <tr>
                                    <td class="text-right"><b>Tanggal Pengiriman</b></td>
                                    <td>{{date_format(date_create($data->created_at), 'd-m-Y')}}</td>
                                </tr>
                                <tr>
                                    <td class="text-right"><b>Judul</b></td>
                                    <td>{{$data->judul}}</td>
                                </tr>
                                <tr>
                                    <td class="text-right"><b>Isi</b></td>
                                    <td>
                                        @if (strtolower($data->judul) == "kode unik peserta try out")
                                            Selamat anda telah terdaftar sebagai peserta:
                                            <table class="mt-1 table table-bordered bg-transparent">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-right"><b>TRY OUT</b></td>
                                                        <td ><span>{{ $data->nama }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right"><b>KELOMPOK UJIAN</b></td>
                                                        <td><span>{{ $data->kelompok_ujian }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right"><b>JADWAL</b></td>
                                                        <td><span>{{date_format(date_create($data->waktu), 'd-m-Y')}}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right"><b>KODE UNIK</b></td>
                                                        <td><span>{{$data->isi}}</span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            Gunakan kode unik di atas untuk login ketika memulai try out
                                        @elseif (strtolower($data->judul) == "hasil try out")
                                            Selamat, Anda telah mengikuti:
                                            <table class="mt-1 table table-bordered bg-transparent">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-right"><b>TRY OUT</b></td>
                                                        <td><span>{{ $data->nama }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right"><b>KELOMPOK UJIAN</b></td>
                                                        <td><span>{{ $data->kelompok_ujian }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right"><b>JADWAL</b></td>
                                                        <td><span>{{date_format(date_create($data->waktu), 'd-m-Y')}}</span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <br><br>
                                            Berikut hasil Try Out Anda:
                                            <table class="mt-1 table table-bordered bg-transparent">
                                                <tbody>
                                                    <tr>
                                                        <th class="text-center" width="42%">ITEM TES</th>
                                                        <th>NILAI</th>
                                                    </tr>
                                                    <?php $rata = 0; ?>
                                                    @foreach ($nilai_peserta as $nilai)
                                                        <tr>
                                                            <td class="text-center">{{ $nilai->nama }}</td>
                                                            <td>{{ $nilai->nilai }}</td>
                                                            <?php 
                                                                $rata += $nilai->nilai;
                                                            ?>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <th class="text-center" width="42%">RATA - RATA</th>
                                                        <th>{{ round($rata/(count($data_subtes)-4), 2) }}</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    {{-- </div> --}}
                    <div class="height-100"></div>
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
