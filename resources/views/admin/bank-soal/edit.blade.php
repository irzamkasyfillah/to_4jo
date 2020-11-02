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
                                            <span class="text-bold-300">Edit Soal</span>
                                        </h3> 
                                    </div>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <form class="form" action="{{ route('soal.update', $data[0]->id_soal) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label for="kategori">Kategori Soal</label>
                                                    <select id="kategori" name="kategori" class="form-control">
                                                        <option @if($data[0]->kategori == 'TPS') {{ 'selected' }} @endif value="TPS">TPS</option>
                                                        <option @if($data[0]->kategori == 'SAINTEK') {{ 'selected' }} @endif value="SAINTEK">SAINTEK</option>
                                                        <option @if($data[0]->kategori == 'SOSHUM') {{ 'selected' }} @endif value="SOSHUM">SOSHUM</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="subtes">Subtes</label>
                                                    <select id="subtes" name="subtes" class="form-control">
                                                        <option required value="{{ $data[0]->subtes}}" selected="" disabled="">{{ $data[0]->subtes}}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="deskripsi">Deskripsi Soal</label>
                                                    <textarea value="" required id="deskripsi" rows="5" class="form-control" name="deskripsi" placeholder="...">{{ $data[0]->deskripsi }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jawaban_benar">Opsi 1 (Benar)</label>
                                                    <input required value="{{ $data[0]->jawaban_benar }}" id="jawaban_benar" type="text" class="form-control" name="jawaban_benar">
                                                </div>
                                                <div class="form-group">
                                                    <label for="jawaban_salah_1">Opsi 2</label>
                                                    <input required value="{{ $data[0]->jawaban_salah_1 }}" id="jawaban_salah_1" type="text" class="form-control" name="jawaban_salah_1">
                                                </div>
                                                <div class="form-group">
                                                    <label for="jawaban_salah_2">Opsi 3</label>
                                                    <input required value="{{ $data[0]->jawaban_salah_2 }}" id="jawaban_salah_2" type="text" class="form-control" name="jawaban_salah_2">
                                                </div>
                                                <div class="form-group">
                                                    <label for="jawaban_salah_3">Opsi 4</label>
                                                    <input required value="{{ $data[0]->jawaban_salah_3 }}" id="jawaban_salah_3" type="text" class="form-control" name="jawaban_salah_3">
                                                </div>
                                                <div class="form-group">
                                                    <label for="jawaban_salah_4">Opsi 5</label>
                                                    <input required value="{{ $data[0]->jawaban_salah_4 }}" id="jawaban_salah_4" type="text" class="form-control" name="jawaban_salah_4">
                                                </div>
                                                <div class="form-actions">
                                                    <a href="../../" type="button" class="btn btn-warning mr-1">
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
    $(document).ready(function() {
        var kat = $('#kategori').val();

        subtes(kat);
    });

    $('#kategori').change(function(){
        var kat = $('#kategori').val();

        subtes(kat);

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

    function subtes(kat){
        if(kat == 'TPS'){
            $('#subtes').html(`
                <option value="none" selected="" disabled="">Pilih Subtes</option>
                <option @if($data[0]->subtes == 'PENALARAN UMUM') {{ 'selected' }} @endif value="PENALARAN UMUM">PENALARAN UMUM</option>
                <option @if($data[0]->subtes == 'PEMAHAMAN BACAAN DAN MENULIS') {{ 'selected' }} @endif value="PEMAHAMAN BACAAN DAN MENULIS">PEMAHAMAN BACAAN DAN MENULIS</option>
                <option @if($data[0]->subtes == 'PENGETAHUAN DAN PEMAHAMAN UMUM') {{ 'selected' }} @endif value="PENGETAHUAN DAN PEMAHAMAN UMUM">PENGETAHUAN DAN PEMAHAMAN UMUM</option>
                <option @if($data[0]->subtes == 'PENGETAHUAN KUANTITATIF') {{ 'selected' }} @endif value="PENGETAHUAN KUANTITATIF">PENGETAHUAN KUANTITATIF</option>
                <option @if($data[0]->subtes == 'BAHASA INGGRIS') {{ 'selected' }} @endif value="BAHASA INGGRIS">BAHASA INGGRIS</option>
            `);
        } else if (kat == 'SAINTEK') {
            $('#subtes').html(`
                <option value="none" selected="" disabled="">Pilih Subtes</option>
                <option @if($data[0]->subtes == 'MATEMATIKA SAINTEK') {{ 'selected' }} @endif value="MATEMATIKA SAINTEK">MATEMATIKA SAINTEK</option>
                <option @if($data[0]->subtes == 'FISIKA') {{ 'selected' }} @endif value="FISIKA">FISIKA</option>
                <option @if($data[0]->subtes == 'KIMIA') {{ 'selected' }} @endif value="KIMIA">KIMIA</option>
                <option @if($data[0]->subtes == 'BIOLOGI') {{ 'selected' }} @endif value="BIOLOGI">BIOLOGI</option>
            `);
        } else {
            $('#subtes').html(`
                <option value="none" selected="" disabled="">Pilih Subtes</option>
                <option @if($data[0]->subtes == 'MATEMATIKA SOSHUM') {{ 'selected' }} @endif value="MATEMATIKA SOSHUM">MATEMATIKA SOSHUM</option>
                <option @if($data[0]->subtes == 'EKONOMI') {{ 'selected' }} @endif value="EKONOMI">EKONOMI</option>
                <option @if($data[0]->subtes == 'GEOGRAFI') {{ 'selected' }} @endif value="GEOGRAFI">GEOGRAFI</option>
                <option @if($data[0]->subtes == 'SOSIOLOGI DAN SEJARAH') {{ 'selected' }} @endif value="SOSIOLOGI DAN SEJARAH">SOSIOLOGI DAN SEJARAH</option>
            `);
        }
    }
</script>

    @endif
@endsection
