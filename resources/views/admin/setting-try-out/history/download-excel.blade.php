<?php
// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=nama_filenya.xls");
?>
    
    {{-- @foreach ($data_subtes as $data_subtes)
        @if ($data_subtes->id == $subtes_now)
            <h3>{{$data_subtes->nama}}</h3>
        @endif
    @endforeach --}}
    {{-- <html>
        @include('css.admin')

    </html>
    <body>
        <div class="app-content content">
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card">
                                
                                <div class="card-content">
                                    <div class="card-body"> --}}
                                        <h3 class="mb-3"><b>{{$data->nama}}</b></h3>
                                        @foreach ($data_subtes as $data_subtes)
                                            @if ($data_subtes->id == $subtes_now)
                                                <h3>Mapel : {{ ucwords($data_subtes->nama)}}</h3>
                                                <?php break; ?>
                                            @endif
                                        @endforeach
                                        <br>
                                        {{-- <div class=""> --}}
                                            <table class="" border="1" cellpadding="20">
                                                <thead>
                                                    <tr class="">
                                                        <th width="">No</th>
                                                        <th width="">Nama Peserta</th>
                                                        <th width="">Kelas</th>
                                                        <th class="text-center" width="">Benar</th>
                                                        <th class="text-center" width="">Salah</th>
                                                        <th class="text-center" width="">Kosong</th>
                                                        <th class="text-center" width="">Nilai</th>
                                                        <?php $i=1; ?>
                                                        @\
                                                        endforeach
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $j=1; ?>
                                                    @foreach ($data_peserta as $peserta)
                                                    <tr>
                                                        <td class="text-center">{{ $j++ }}</td>
                                                        <td>{{ ucwords($peserta->name) }}</td>
                                                        <td>{{ $peserta->kelompok_ujian }}</td>
                                                        <td class="text-center">{{ $peserta->benar }}</td>
                                                        <td class="text-center">{{ $peserta->salah }}</td>
                                                        <td class="text-center">{{ $peserta->kosong }}</td>
                                                        <td class="text-center">{{ $peserta->nilai }}</td>
                                                        <?php $i=0; ?>
                                                        @foreach ($jawaban_peserta as $jawaban)
                                                            @if ($jawaban->id_peserta == $peserta->id)
                                                                @if ($jawaban->value == 1) 
                                                                    <?php $bg ="green"; $fa = "fa fa-check" ?>
                                                                @elseif (is_null($jawaban->value)) 
                                                                    <?php $bg ="grey"; $fa = "fa fa-minus" ?>
                                                                @elseif ($jawaban->value == 0)
                                                                    <?php $bg ="red"; $fa = "fa fa-times" ?>
                                                                @endif
                                                                <td class="text-center" style="background: {{$bg}}"><i class="white {{$fa}}"></i></td>
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="col-12 mt-3">
                                                <h4 class="mb-2">Keterangan:</h4>
                                                <button style="background: green; height:50px; width:70px" class="btn white"><i class="white fa fa-check mr-1"></i>Benar</button> 
                                                <button style="background: red; height:50px; width:70px" class="btn white"><i class="white fa fa-times mr-1"></i>Salah</button> 
                                                <button style="background: grey; height:50px; width:70px" class="btn white"><i class="white fa fa-minus mr-1"></i>Kosong</button>
                                            </div>
                                        {{-- </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body> --}}
                                    


    
    