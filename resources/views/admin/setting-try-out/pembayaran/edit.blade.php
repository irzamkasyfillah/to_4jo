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
                                            <span class="text-bold-300">Edit Metode Pembayaran</span>
                                        </h3> 
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <form class="form" action="{{ route('setting-pembayaran.update', $data->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label for="teks">Pembayaran</label>
                                                <textarea required class="ckeditor"" name="teks" id="teks">
                                                    <?php echo $data->teks ?>
                                                </textarea>
                                            </div>
                                            <div class="form-actions">
                                                <a href="{{route('setting-pembayaran.index')}}" type="button" class="btn btn-warning mr-1">
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
                <div class="height-100"></div>
            </div>
        </div>
    </div>
</div>

    @endif
@endsection
