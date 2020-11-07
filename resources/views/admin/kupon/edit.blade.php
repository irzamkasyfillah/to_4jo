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
                                            <span class="text-bold-300">Edit Kupon</span>
                                        </h3> 
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <form class="form" action="{{ route('kupon.update', $data[0]->id_kupon) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label for="kode_kupon">Kode Kupon</label>
                                                <input value="{{$data[0]->kode_kupon}}" class="form-control" type="text" name="kode_kupon" id="kode">
                                            </div>
                                            <div class="form-group">
                                                <label for="id_tryout">Try Out</label>
                                                <select required id="id_tryout" name="id_tryout" class="form-control">
                                                    <input hidden readonly id="tryout" value="{{$data[0]->id_tryout}}" type="text">
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="persen">Persen (%)</label>
                                                <input value="{{$data[0]->persen}}" required class="form-control" type="number" min="0" name="persen" id="persen">
                                            </div>
                                            <div class="form-actions">
                                                <a href="{{route('kupon.index')}}" type="button" class="btn btn-warning mr-1">
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
        var to = $('#tryout').val();

        $.ajax({
            url: '../../get_tryout/',
            datatype: 'json',
            success: function(data){
                var obj = JSON.parse(data);
                console.log(obj)
                $('#id_tryout').append(`
                        <option value="" disabled="">Pilih Try Out</option>
                    `);

                for (i = 0; i < obj.length; i++) {
                    if(to == obj[i]['id']){
                        var select = 'selected';
                    }else{
                        var select = '';
                    }
                    
                    $('#id_tryout').append(`
                        <option value="`+obj[i]['id']+`" `+select+`>`+obj[i]['nama']+`</option>
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
