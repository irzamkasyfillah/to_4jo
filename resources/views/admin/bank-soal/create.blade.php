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
                                </div>
                            </div>
                            <hr>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <form class="form" action="{{ route('soal.store') }}" method="POST">
                                        @csrf
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label for="kategori">Kategori Soal</label>
                                                    <select required  id="kategori" name="kategori" class="form-control">
                                                        <option value="" selected="" disabled="">Pilih kategori</option>
                                                        <option value="TPS">TPS</option>
                                                        <option value="SAINTEK">SAINTEK</option>
                                                        <option value="SOSHUM">SOSHUM</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="subtes">Subtes</label>
                                                    <select required  id="subtes" name="subtes" class="form-control">
                                                        <option value="" selected="" disabled="">Pilih Subtes</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="deskripsi">Deskripsi Soal</label>
                                                    <textarea required id="deskripsi" rows="5" class="ckeditor" name="deskripsi" placeholder="..."></textarea>
                                                </div>  
                                                <div class="form-group">
                                                    <label for="jawaban_benar">Opsi 1 (Benar)</label>
                                                    <textarea id="jawaban_benar" rows="2" class="ckeditor" name="jawaban_benar" placeholder="Opsi 1 (Benar)"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jawaban_salah_1">Opsi 2</label>
                                                    <textarea id="jawaban_salah_1" rows="2" class="ckeditor" name="jawaban_salah_1" placeholder="Opsi 2"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jawaban_salah_2">Opsi 3</label>
                                                    <textarea id="jawaban_salah_2" rows="2" class="ckeditor" name="jawaban_salah_2" placeholder="Opsi 3"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jawaban_salah_3">Opsi 4</label>
                                                    <textarea id="jawaban_salah_3" rows="2" class="ckeditor" name="jawaban_salah_3" placeholder="Opsi 4"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jawaban_salah_4">Opsi 5</label>
                                                    <textarea id="jawaban_salah_4" rows="2" class="ckeditor" name="jawaban_salah_4" placeholder="Opsi 5"></textarea>
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

        $.ajax({
            url: '../../soal/get_subtes/'+kat,
            datatype: 'json',
            success: function(data){
                var obj = JSON.parse(data);
                console.log(obj);
                $('#subtes').empty();
                $('#subtes').append(`
                        <option required value="" selected="" disabled="">Pilih Subtes</option>
                    `);
                for (i=0; i<=obj.length; i++) {
                    $('#subtes').append(`
                        <option required value="`+obj[i]['id']+`">`+obj[i]['nama']+`</option>
                    `);
                }
            },
            error: function(data){
                console.log(data);
            }
        });
    });
</script>

    @endif
@endsection
