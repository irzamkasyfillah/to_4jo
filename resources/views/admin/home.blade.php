    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-6   border-right-grey border-right-lighten-3 clearfix">
                                            <div class="float-left">
                                                <span class="grey darken-1 block"><b>Jumlah User</b><br> Terdaftar di sistem</span>
                                            </div>
                                            <div id="jumlah-user" class="float-right">
                                                {{-- <span class="font-large-3 text-bold-300">25</span> --}}
                                            </div>
                                        </div>
                                        {{-- <div class="col-xl-4   border-right-grey border-right-lighten-3 clearfix">
                                            <div class="float-left">
                                                <span class="grey darken-1 block"><b>User Online</b></span>
                                            </div>
                                            <div class="float-right">
                                                <span class="font-large-3 text-bold-300">5</span>
                                            </div>
                                        </div> --}}
                                        <div class="col-xl-6 clearfix">
                                            <div class="float-left">
                                                <span class="grey darken-1 block"><b>Jumlah Ujian Aktif</b><br> Telah diaktifkan</span>
                                            </div>
                                            <div id="jumlah-ujian" class="float-right">
                                                <span class="font-large-3 text-bold-300">{{ count($data_tryout) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-8 col-lg-12">
                        <div class="card">
                            <div class="card-header no-border-bottom">
                                <h3><span class="text-bold-300">Daftar Ujian Aktif</span></h3>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="bg-teal bg-lighten-4">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nama Ujian</th>
                                                    <th>Jumlah Peserta</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i=0; ?>
                                                @foreach ($data_tryout as $data)
                                                <tr>
                                                    <th scope="row">{{ $i+1 }}</th>
                                                    <td>{{ ucwords($data->nama) }}</td>
                                                    <td>{{ $jml_peserta[$i++] }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="height-200"></div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: '../../jumlah-user',
                datatype: 'json',
                success: function(data){
                    var obj = JSON.parse(data);

                    $('#jumlah-user').append(`
                            <span class="font-large-3 text-bold-300">`+obj.length+`</span>
                        `);
                },
                error: function(data){
                    console.log(data);
                }
            });            
        });
    </script>

    <!-- ////////////////////////////////////////////////////////////////////////////-->
    