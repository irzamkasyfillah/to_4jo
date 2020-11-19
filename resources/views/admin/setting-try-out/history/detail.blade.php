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
                                            <span class="text-bold-300">Detail History {{$data->nama}}</strong></span>
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
                                        <form action="{{ route('history-try-out.show', $data->id)}}" method="GET">
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
                                                    <th width="">Benar</th>
                                                    <th width="">Salah</th>
                                                    <th width="">Kosong</th>
                                                    <th width="">Nilai</th>
                                                    <th width="10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="body">
                                                @foreach ($data_peserta as $peserta)
                                                <tr>
                                                    <td>{{ $peserta->name }}</td>
                                                    <td>{{ $peserta->kelompok_ujian }}</td>
                                                    <td>{{ $peserta->benar }}</td>
                                                    <td>{{ $peserta->salah }}</td>
                                                    <td>{{ $peserta->kosong }}</td>
                                                    <td></td>
                                                    <td></td>
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
        <div class="height-100"></div>
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
    