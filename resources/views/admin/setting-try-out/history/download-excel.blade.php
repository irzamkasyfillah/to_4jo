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
                                        {{-- <h3 class="mb-3"><b>{{$data->nama}}</b></h3>
                                        @foreach ($data_subtes as $data_subtes)
                                            @if ($data_subtes->id == $subtes_now)
                                                <h3>Mapel : {{ ucwords($data_subtes->nama)}}</h3>
                                                <?php break; ?>
                                            @endif
                                        @endforeach
                                        <br> --}}
                                        {{-- <div class=""> --}}
                                            <table class="">
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
                                                        {{-- @foreach ($collect[0]['rekap'] as $rekap)
                                                            <th class="text-center">No.{{ $i++ }}</th>
                                                        @endforeach --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $j=1; ?>
                                                    @foreach ($collect as $peserta)
                                                    <tr>
                                                        <td class="text-center">{{ $j++ }}</td>
                                                        <td>{{ ucwords($peserta['nama']) }}</td>
                                                        <td>{{ $peserta['kelas'] }}</td>
                                                        <td class="text-center">{{ $peserta['benar'] }}</td>
                                                        <td class="text-center">{{ $peserta['salah'] }}</td>
                                                        <td class="text-center">{{ $peserta['kosong'] }}</td>
                                                        <td class="text-center">{{ $peserta['nilai'] }}</td>
                                                        {{-- @foreach ($peserta['rekap'] as $rekap)
                                                            
                                                            <td style="background: {{$bg}}" class="text-center">{{ $rekap }}</td>
                                                        @endforeach --}}
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            {{-- <div class="col-12 mt-3">
                                                <h4 class="mb-2">Keterangan:</h4>
                                                <button style="background: green; height:50px; width:70px" class="btn white"><i class="white fa fa-check mr-1"></i>Benar</button> 
                                                <button style="background: red; height:50px; width:70px" class="btn white"><i class="white fa fa-times mr-1"></i>Salah</button> 
                                                <button style="background: grey; height:50px; width:70px" class="btn white"><i class="white fa fa-minus mr-1"></i>Kosong</button>
                                            </div> --}}
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
                                    


    
    