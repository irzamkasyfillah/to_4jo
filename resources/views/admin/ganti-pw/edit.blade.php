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
                <!-- fitness stats -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header no-border-bottom">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <h3>
                                            <span class="text-bold-300">Ganti Password</span>
                                        </h3> 
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        {{-- <form class="form" > --}}
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label for="teks">Email</label>
                                                    <input type="email" value="{{ $data->email }}" name="email" id="email" required class="form-control @error('email') is-invalid @enderror">
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="teks">Password Lama</label>
                                                    <input type="password" name="" id="password_lama" required class="form-control">
                                                    <div id="error_pass_lama">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="teks">Password Baru</label>
                                                    <input type="password" name="password" id="password_baru" class="form-control">
                                                    <div id="error_pass_baru">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="teks">Confirm Password Baru</label>
                                                    <input type="password" name="" id="confirm_password_baru" class="form-control">
                                                    <div id="error_confirm">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-actions">
                                                    <a href="{{ route('home') }}" type="button" class="btn btn-warning mr-1">
                                                        <i class="ft-x"></i> Cancel
                                                    </a>
                                                    <button id="submit" class="btn btn-primary">
                                                        <i class="fa fa-check-square-o"></i> Save
                                                    </button>
                                                </div>
                                            </div>
                                        {{-- </form> --}}
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

<input type="hidden" value="{{ $data->id }}" id="id">

<script>
    $('#submit').click(function() {
        var base_url = window.location.origin;
        var id = $('#id').val();
        var pw_lama = $('#password_lama').val();
        var pw_baru = $('#password_baru').val();
        var confirm_pw_baru = $('#confirm_password_baru').val();
        var email = $('#email').val();
        console.log(pw_lama);

        $('#error_confirm').empty();
        $('#error_pass_lama').empty();
        $('#error_pass_baru').empty();
        if (pw_lama == "") {
            $('#error_pass_lama').append(`
                <div class="danger font-small-3 text-muted mt-1">Please fill out this field</div>
            `);    
           
        } else {
            console.log(pw_lama);
            $.ajax({
                url: base_url+'/check-password/'+id+'/'+pw_lama,
                success: function(data){
                    // console.log(data);
                    if (data == 'true') {
                        if (pw_baru == "") {
                            $('#error_pass_baru').append(`
                                <div class="danger font-small-3 text-muted mt-1">Please fill out this field</div>
                            `);    
                        } else {
                            if (pw_baru == confirm_pw_baru) {
                                window.location.assign(base_url+'/update-password/'+id+'/'+pw_baru+'/'+email);
                            } else {
                                $('#error_confirm').append(`
                                    <div class="danger font-small-3 text-muted mt-1">Your password didn't match!</div>
                                `)    
                            }
                        }
                    } else {
                        $('#error_pass_lama').append(`
                            <div class="danger font-small-3 text-muted mt-1">Your old password is incorrect!</div>
                        `)
                    }

                },
                error: function(data){
                    console.log(data);
                }
            });
        }
    });

</script>
    @endif
@endsection
