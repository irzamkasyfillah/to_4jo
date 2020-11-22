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
                                            <span class="text-bold-300">Detail History <b>{{ucwords($data->nama)}}</b></strong></span>
                                        </h3> 
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="mb-2">
                                        <input type="hidden" name="id_to" value="{{$data->id}}" id="id_to">
                                        <label for="id_tryout">Subtes</label>
                                        <form action="{{ route('show-nilai.show', [$data->id, 1])}}" method="GET">
                                            <div class="input-group">
                                                <select required id="subtes" name="subtes" class="form-control">
                                                    <option value="" selected="" disabled="">Pilih Subtes</option>
                                                    @foreach ($data_subtes as $data_subtes)
                                                        @if ($data_subtes->id == $subtes_now)
                                                            <?php $selected = "selected" ?>
                                                        @else
                                                            <?php $selected = "" ?>
                                                        @endif
                                                        <option {{$selected}} value="{{$data_subtes->id}}">{{$data_subtes->nama}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-info btn-min-width">Pilih</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="data" class="table table-hover table-striped table-bordered zero-configuration">
                                            <thead>
                                                <tr class="">
                                                    <th width="">Nama Peserta</th>
                                                    <th width="">Kelas</th>
                                                    <th class="text-center" width="">Benar</th>
                                                    <th class="text-center" width="">Salah</th>
                                                    <th class="text-center" width="">Kosong</th>
                                                    <th class="text-center" width="">Nilai</th>
                                                    <?php $i=1; ?>
                                                    @foreach ($array_soal as $soal)
                                                        <th class="text-center">No. {{ $i++ }}</th>
                                                    @endforeach
                                                    <th width="10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="body">
                                                @foreach ($data_peserta as $peserta)
                                                <tr>
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
                                                                <?php $bg ="bg-success"; $fa = "fa fa-check" ?>
                                                            @elseif (is_null($jawaban->value)) 
                                                                <?php $bg ="bg-grey"; $fa = "fa fa-minus" ?>
                                                            @elseif ($jawaban->value == 0)
                                                                <?php $bg ="bg-danger"; $fa = "fa fa-times" ?>
                                                            @endif
                                                            <td class="text-center white {{ $bg }}"><i class="mt-1 {{ $fa }}"></i></td>
                                                        @endif
                                                    @endforeach
                                                    <td class="text-center">
                                                        <a data-toggle="tooltip" data-placement="top" title="Edit Nilai" href="{{ route('edit-nilai.edit', [$data->id, $subtes_now, $peserta->id]) }}" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            {{-- <tfoot>
                                                <tr class="">
                                                    <th>Nama Peserta</th>
                                                    <th>Kelas</th>
                                                    <th>Benar</th>
                                                    <th>Salah</th>
                                                    <th>Kosong</th>
                                                    <th>Nilai</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </tfoot> --}}
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="height-200"></div>
    </div>

    {{-- <script>
        $('#subtes').change(function(){
            var id_to = $('#id_to').val();
            var subtes = $('#subtes').val();
    
            $.ajax({
                url: '../../get_rekap_peserta/'+id_to+'/'+subtes,
                datatype: 'json',
                success: function(data){
                    var obj = JSON.parse(data);
                    console.log(obj);
                    $('#body').empty();
                    for (i=0; i<=obj.length; i++) {
                        $('#body').append(`
                            <tr>
                                <td>`+obj[i]['name']+`</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        `);
                    }
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
    </script> --}}

    @endif
@endsection
    