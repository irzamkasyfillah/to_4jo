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
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header no-border-bottom">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <h3>
                                            <span class="text-bold-300">List Soal <b>{{ $data_tryout->nama }}</b></span>
                                        </h3> 
                                    </div>
                                    <div class="col-xl-6 text-right">
                                        <a href="{{ route('data-tryout.index') }}" class="btn btn-info">Kembai ke Daftar Try Out</a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-content">
                                <div class="card-body">
                                    <?php
                                        $kategori = array('TPS', 'SAINTEK', 'SOSHUM');
                                        $warna = array('bg-success', 'bg-danger', 'bg-info');
                                        $i = 0;
                                    ?>
                                    @foreach ($kategori as $kategori)
                                        <h6 class=""><i class="fa fa-caret-right"></i> <b>{{ $kategori }}</b></h6>
                                        <hr>

                                        <div id="accordionWrap" role="tablist" aria-multiselectable="true">
                                            <div class="card collapse-icon accordion-icon-rotate">
                                                @foreach ($data_subtes as $subtes)
                                                    @if ($subtes->kategori == $kategori)
                                                        <div id="heading{{ $subtes->id }}"  class="card-header {{ $warna[$i] }}" role="tab">
                                                            <a data-toggle="collapse" data-parent="#accordionWrap" href="#subtes{{  $subtes->id }}" aria-expanded="false"  class="card-title lead white">{{ $subtes->nama }}</a>
                                                        </div>
                                                        
                                                        <div id="subtes{{$subtes->id }}" role="tabpanel" aria-labelledby="heading{{ $subtes->id }}" class="collapse">
                                                            <table class="table  bg-light table-striped table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="5%">No.</th>
                                                                        <th class="text-center">Soal</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $no = 1; ?>
                                                                    @foreach ($data_soal as $soal)
                                                                        @if ($soal->subtes == $subtes->id)
                                                                            @if ($data_tryout->soal != "" || $data_tryout->soal != null)
                                                                                @foreach ($data_tryout->soal as $soal_check)
                                                                                    @if ($soal->id == intval($soal_check))
                                                                                        <tr>
                                                                                            <td class="text-center">
                                                                                                {{$no++}}
                                                                                            </td>
                                                                                            <td>
                                                                                                <?php echo $soal->deskripsi ?>
                                                                                            </td>
                                                                                       </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                    <div class="pl-2 pr-2 pt-1 pb-1 {{ $warna[$i] }} white"> Jumlah soal : {{ $no-1}}</div>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <br>            
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div> 
                                        <?php $i++; ?>
                                    @endforeach                             
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="height-100"></div>
    @endif
@endsection
    