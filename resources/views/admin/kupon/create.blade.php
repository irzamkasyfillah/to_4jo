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
                                            <span class="text-bold-300">Tambah Kupon</span>
                                        </h3> 
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <form class="form" action="{{ route('kupon.store') }}" method="POST">
                                        @csrf
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label for="kode_kupon">Kode Kupon</label>
                                                    <input class="form-control" type="text" name="kode_kupon" id="kode">
                                                </div>
                                                <div class="form-group">
                                                    <label for="id_tryout">Try Out</label>
                                                    <select required id="id_tryout" name="id_tryout" class="form-control">
                                                        <option value="" selected="" disabled="">Pilih Try Out</option>
                                                        @foreach ($data_tryout as $data_tryout)
                                                            <option value="{{$data_tryout->id}}">{{$data_tryout->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="persen">Persen (%)</label>
                                                    <input required class="form-control" type="number" min="0" name="persen" id="persen">
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

    @endif
@endsection
