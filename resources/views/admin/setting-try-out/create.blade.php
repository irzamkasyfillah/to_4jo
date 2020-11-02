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
                                                    <input type="text" id="nama" name="nama" class="form-control" placeholder="contoh: TRY OUT UTBK 2020 PART 1">
                                                </div>
                                                <div class="form-group">
                                                    <label for="harga">Harga (dalam rupiah)</label>
                                                    <input id="harga" type="number" class="form-control" name="harga" placeholder="contoh: 9000">
                                                </div>
                                                <div class="form-group">
                                                    <label for="waktu">Waktu Pelaksanaan</label>
                                                    <input id="waktu" type="datetime-local" class="form-control" name="waktu">
                                                </div>
                                                <hr>
                                                <label for="soal">Pilih Soal</label>
                                                <div class="form-group">
                                                    <label for="soal"><i class="fa fa-caret-right"></i><b> TPS</b></label><br>
                                                    <label for="soal" class="mb-1"> PENALARAN UMUM</label>
                                                    <fieldset class="checkboxsas">
                                                        @foreach ($soal_pu as $soal_pu)
                                                        <div class="col-12 mb-1">
                                                            <input name="soal[]" class="mr-1" type="checkbox" value="{{ $soal_pu->id}}">{{ $soal_pu->deskripsi }}
                                                        </div>
                                                        @endforeach
                                                    </fieldset>
                                                    <label for="soal" class="mt-1 mb-1"> PEMAHAMAN BACAAN DAN MENULIS</label>
                                                    <fieldset class="checkboxsas">
                                                        @foreach ($soal_pbm as $soal_pbm)
                                                        <div class="col-12 mb-1">
                                                            <input name="soal[]" class="mr-1" type="checkbox" value="{{ $soal_pbm->id}}">{{ $soal_pbm->deskripsi }}
                                                        </div>
                                                        @endforeach
                                                    </fieldset>
                                                    <label for="soal" class="mt-1 mb-1"> PENGETAHUAN DAN PEMAHAMAN UMUM</label>
                                                    <fieldset class="checkboxsas">
                                                        @foreach ($soal_ppu as $soal_ppu)
                                                        <div class="col-12 mb-1">
                                                            <input name="soal[]" class="mr-1" type="checkbox" value="{{ $soal_ppu->id}}">{{ $soal_ppu->deskripsi }}
                                                        </div>
                                                        @endforeach
                                                    </fieldset>
                                                    <label for="soal" class=" mt-1 mb-1"> PENGETAHUAN KUANTITATIF</label>
                                                    <fieldset class="checkboxsas">
                                                        @foreach ($soal_pk as $soal_pk)
                                                        <div class="col-12 mb-1">
                                                            <input name="soal[]" class="mr-1" type="checkbox" value="{{ $soal_pk->id}}">{{ $soal_pk->deskripsi }}
                                                        </div>
                                                        @endforeach
                                                    </fieldset>
                                                    <label for="soal" class="mt-1 mb-1"> BAHASA INGGRIS</label>
                                                    <fieldset class="checkboxsas">
                                                        @foreach ($soal_bi as $soal_bi)
                                                        <div class="col-12 mb-1">
                                                            <input name="soal[]" class="mr-1" type="checkbox" value="{{ $soal_bi->id}}">{{ $soal_bi->deskripsi }}
                                                        </div>
                                                        @endforeach
                                                    </fieldset>
                                                </div>
                                                <hr>
                                                <div class="form-group">
                                                    <label for="soal"><i class="fa fa-caret-right"></i><b> TKA SAINTEK</b></label><br>
                                                    <label for="soal" class="mb-1"> MATEMATIKA SAINTEK</label>
                                                    <fieldset class="checkboxsas">
                                                        @foreach ($soal_msa as $soal_msa)
                                                        <div class="col-12 mb-1">
                                                            <input name="soal[]" class="mr-1" type="checkbox" value="{{ $soal_msa->id}}">{{ $soal_msa->deskripsi }}
                                                        </div>
                                                        @endforeach
                                                    </fieldset>
                                                    <label for="soal" class=" mt-1 mb-1"> FISIKA</label>
                                                    <fieldset class="checkboxsas">
                                                        @foreach ($soal_f as $soal_f)
                                                        <div class="col-12 mb-1">
                                                            <input name="soal[]" class="mr-1" type="checkbox" value="{{ $soal_f->id}}">{{ $soal_f->deskripsi }}
                                                        </div>
                                                        @endforeach
                                                    </fieldset>
                                                    <label for="soal" class=" mt-1 mb-1"> KIMIA</label>
                                                    <fieldset class="checkboxsas">
                                                        @foreach ($soal_k as $soal_k)
                                                        <div class="col-12 mb-1">
                                                            <input name="soal[]" class="mr-1" type="checkbox" value="{{ $soal_k->id}}">{{ $soal_k->deskripsi }}
                                                        </div>
                                                        @endforeach
                                                    </fieldset>
                                                    <label for="soal" class="mt-1 mb-1"> BIOLOGI</label>
                                                    <fieldset class="checkboxsas">
                                                        @foreach ($soal_b as $soal_b)
                                                        <div class="col-12 mb-1">
                                                            <input name="soal[]" class="mr-1" type="checkbox" value="{{ $soal_b->id}}">{{ $soal_b->deskripsi }}
                                                        </div>
                                                        @endforeach
                                                    </fieldset>
                                                </div>
                                                <hr>
                                                <div class="form-group">
                                                    <label for="soal"><i class="fa fa-caret-right"></i><b> TKA SOSHUM</b></label><br>
                                                    <label for="soal" class="mb-1"> MATEMATIKA SOSHUM</label>
                                                    <fieldset class="checkboxsas">
                                                        @foreach ($soal_mso as $soal_mso)
                                                        <div class="col-12 mb-1">
                                                            <input name="soal[]" class="mr-1" type="checkbox" value="{{ $soal_mso->id}}">{{ $soal_mso->deskripsi }}
                                                        </div>
                                                        @endforeach
                                                    </fieldset>
                                                    <label for="soal" class="mt-1 mb-1"> EKONOMI</label>
                                                    <fieldset class="checkboxsas">
                                                        @foreach ($soal_e as $soal_e)
                                                        <div class="col-12 mb-1">
                                                            <input name="soal[]" class="mr-1" type="checkbox" value="{{ $soal_e->id}}">{{ $soal_e->deskripsi }}
                                                        </div>
                                                        @endforeach
                                                    </fieldset>
                                                    <label for="soal" class="mt-1 mb-1"> GEOGRAFI</label>
                                                    <fieldset class="checkboxsas">
                                                        @foreach ($soal_g as $soal_g)
                                                        <div class="col-12 mb-1">
                                                            <input name="soal[]" class="mr-1" type="checkbox" value="{{ $soal_g->id}}">{{ $soal_g->deskripsi }}
                                                        </div>
                                                        @endforeach
                                                    </fieldset>
                                                    <label for="soal" class=" mt-1 mb-1"> SOSIOLOGI DAN SEJARAH</label>
                                                    <fieldset class="checkboxsas">
                                                        @foreach ($soal_ss as $soal_ss)
                                                        <div class="col-12 mb-1">
                                                            <input name="soal[]" class="mr-1" type="checkbox" value="{{ $soal_ss->id}}">{{ $soal_ss->deskripsi }}
                                                        </div>
                                                        @endforeach
                                                    </fieldset>
                                                </div>
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

<script>
    $('#kategori').change(function(){
        var kat = $('#kategori').val();

        if(kat == 'TPS'){
            $('#subtes').html(`
                <option value="none" selected="" disabled="">Pilih Subtes</option>
                <option value="PENALARAN UMUM">PENALARAN UMUM</option>
                <option value="PEMAHAMAN BACAAN DAN MENULIS">PEMAHAMAN BACAAN DAN MENULIS</option>
                <option value="PENGETAHUAN DAN PEMAHAMAN UMUM">PENGETAHUAN DAN PEMAHAMAN UMUM</option>
                <option value="PENGETAHUAN KUANTITATIF">PENGETAHUAN KUANTITATIF</option>
                <option value="BAHASA INGGRIS">BAHASA INGGRIS</option>
            `);
        } else if (kat == 'SAINTEK') {
            $('#subtes').html(`
                <option value="none" selected="" disabled="">Pilih Subtes</option>
                <option value="MATEMATIKA SAINTEK">MATEMATIKA SAINTEK</option>
                <option value="FISIKA">FISIKA</option>
                <option value="KIMIA">KIMIA</option>
                <option value="BIOLOGI">BIOLOGI</option>
            `);
        } else {
            $('#subtes').html(`
                <option value="none" selected="" disabled="">Pilih Subtes</option>
                <option value="MATEMATIKA SOSHUM">MATEMATIKA SOSHUM</option>
                <option value="EKONOMI">EKONOMI</option>
                <option value="GEOGRAFI">GEOGRAFI</option>
                <option value="SOSIOLOGI DAN SEJARAH">SOSIOLOGI DAN SEJARAH</option>
            `);
        }

        // $.ajax({
        //     url: '../../soal/get_subtes/'+kat,
        //     datatype: 'json',
        //     success: function(data){
        //         alert('berhasil');
        //         var obj = JSON.parse(data);
        //     },
        //     error: function(data){
        //         console.log(data);
        //     }
        // });
    });
</script>

    @endif
@endsection
