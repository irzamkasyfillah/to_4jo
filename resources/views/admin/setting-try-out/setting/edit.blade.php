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
                                            <span class="text-bold-300">Setting <i class="fa fa-caret-right ml-1 mr-1"></i> Edit Subtes</span>
                                        </h3> 
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <form class="form" action="{{ route('setting-waktu-pengerjaan-subtes.update', $data->id) }}" method="POST">
                                        @csrf
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label for="subtes">Subtes</label>
                                                <input readonly value="{{$data->nama}}" class="form-control" type="text" name="subtes" id="subtes">
                                            </div>
                                            <div class="form-group">
                                                <label for="kategori">Kategori</label>
                                                <input readonly value="{{$data->kategori}}" class="form-control" type="text" name="kategori" id="kategori">
                                            </div>
                                            <div class="form-group">
                                                <label for="subtes">Waktu Pengerjaan (Menit)</label>
                                                <input required value="{{$data->durasi}}" class="form-control" type="number" min="0" name="durasi" id="durasi">
                                            </div>
                                            <div class="form-actions">
                                                <a href="{{route('setting-waktu-pengerjaan-subtes.index')}}" type="button" class="btn btn-warning mr-1">
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
