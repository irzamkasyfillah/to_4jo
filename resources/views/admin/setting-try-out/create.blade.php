@extends('layouts.app')

@section('content')
    @if (Auth::user()->level == 'admin')
        @include('admin.include')


    
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- fitness stats -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header no-border-bottom">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <h3>
                                            <span class="text-bold-300">Tambah Try Out</span>
                                        </h3> 
                                    </div>
                                    {{-- <div class="col-xl-6 text-right">
                                        <a href="{{ route('soal.create') }}" class="btn btn-info"><i class="ft-plus"></i> Tambah Soal</a>
                                    </div> --}}
                                </div>
                            </div>
                            <hr>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <form class="form" action="{{ route('data-tryout.store') }}" method="POST">
                                        @csrf
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label for="nama">Nama Try Out</label>
                                                    <input required type="text" id="nama" name="nama" class="form-control" placeholder="contoh: TRY OUT UTBK 2020 PART 1">
                                                </div>
                                                <div class="form-group">
                                                    <label for="harga">Harga (dalam rupiah)</label>
                                                    <input required id="harga" type="number" min="0" class="form-control" name="harga" placeholder="contoh: 9000">
                                                </div>
                                                <div class="form-group">
                                                    <label for="waktu">Waktu Pelaksanaan</label>
                                                    <input id="waktu" type="datetime-local" class="form-control" name="waktu">
                                                </div>
                                                <hr>
                                                <h5 class="text-center">Pilih Soal</h5>
                                                <?php
                                                    $kategori = array('TPS', 'SAINTEK', 'SOSHUM');
                                                    $warna = array('bg-success', 'bg-danger', 'bg-info');
                                                    $i = 0;
                                                ?>
                                                @foreach ($kategori as $kategori)
                                                    <h6 class=""><i class="fa fa-caret-right"></i> <b>{{ $kategori }}</b></h6>
                                                    <hr>

                                                    <div id="accordionWrapa1" role="tablist" aria-multiselectable="true">
                                                        <div class="card collapse-icon accordion-icon-rotate">
                                                            @foreach ($data_subtes as $subtes)
                                                                @if ($subtes->kategori == $kategori)
                                                                    
                                                                    <div id="heading{{ $subtes->id }}"  class="card-header {{ $warna[$i] }}" role="tab">
                                                                        <a data-toggle="collapse" data-parent="#accordionWrapa1" href="#subtes{{ $subtes->id }}" aria-expanded="false"  class="card-title lead white">{{ $subtes->nama }}</a>
                                                                    </div>
                                                                    
                                                                    <div id="subtes{{ $subtes->id }}" role="tabpanel" aria-labelledby="heading{{ $subtes->id }}" class="collapse">
                                                                        <table class="table bg-light table-striped table-bordered">
                                                                            @foreach ($data_soal as $soal)
                                                                                @if ($soal->subtes == $subtes->id)
                                                                                    <tr>
                                                                                        <td>
                                                                                            <input name="soal[]" class="mr-1" type="checkbox" value="{{ $soal->id}}">{{ $soal->deskripsi }}
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach
                                                                        </table>
                                                                    </div>
                                                                    <br>            
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <?php $i++ ?>    
                                                @endforeach 
                                                <div class="form-actions">
                                                    <a href="../../data-tryout" type="button" class="btn btn-warning mr-1">
                                                        <i class="ft-x"></i> Cancel
                                                    </a>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fa fa-check-square-o"></i> Save
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
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
@endsection
