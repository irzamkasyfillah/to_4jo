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
                                            <span class="text-bold-300">Tambah Soal</span>
                                        </h3> 
                                    </div>
                                    {{-- <div class="col-xl-6 text-right">
                                        <a href="{{ route('soal.create') }}" class="btn btn-info"><i class="ft-plus"></i> Tambah Soal</a>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <form class="form" action="{{ route('soal.store') }}" method="POST">
                                        @csrf
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label for="kategori">Kategori Soal</label>
                                                    <select id="kategori" name="kategori" class="form-control">
                                                        <option required value="" selected="" disabled="">Pilih kategori</option>
                                                        <option value="TPS">TPS</option>
                                                        <option value="SAINTEK">SAINTEK</option>
                                                        <option value="SOSHUM">SOSHUM</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="subtes">Subtes</label>
                                                    <select id="subtes" name="subtes" class="form-control">
                                                        <option required value="" selected="" disabled="">Pilih Subtes</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="deskripsi">Deskripsi Soal</label>
                                                    <textarea required id="deskripsi" rows="5" class="form-control" name="deskripsi" placeholder="..."></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jawaban_benar">Opsi 1 (Benar)</label>
                                                    <input id="jawaban_benar" type="text" class="form-control" name="jawaban_benar">
                                                </div>
                                                <div class="form-group">
                                                    <label for="jawaban_salah_1">Opsi 2</label>
                                                    <input id="jawaban_salah_1" type="text" class="form-control" name="jawaban_salah_1">
                                                </div>
                                                <div class="form-group">
                                                    <label for="jawaban_salah_2">Opsi 3</label>
                                                    <input id="jawaban_salah_2" type="text" class="form-control" name="jawaban_salah_2">
                                                </div>
                                                <div class="form-group">
                                                    <label for="jawaban_salah_3">Opsi 4</label>
                                                    <input id="jawaban_salah_3" type="text" class="form-control" name="jawaban_salah_3">
                                                </div>
                                                <div class="form-group">
                                                    <label for="jawaban_salah_4">Opsi 5</label>
                                                    <input id="jawaban_salah_4" type="text" class="form-control" name="jawaban_salah_4">
                                                </div>
                                                <div class="form-actions">
                                                    <a href="../" type="button" class="btn btn-warning mr-1">
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
