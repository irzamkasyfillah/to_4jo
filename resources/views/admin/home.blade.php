    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                         <!--fitness stats-->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-4   border-right-grey border-right-lighten-3 clearfix">
                            <div class="float-left">
                                <span class="grey darken-1 block"><b>Jumlah User</b><br> Terdaftar di sistem</span>
                            </div>
                            <div class="float-right">
                                <span class="font-large-3 text-bold-300">25</span>
                            </div>
                        </div>
                        <div class="col-xl-4   border-right-grey border-right-lighten-3 clearfix">
                            <div class="float-left">
                                <span class="grey darken-1 block"><b>User Online</b></span>
                            </div>
                            <div class="float-right">
                                <span class="font-large-3 text-bold-300">5</span>
                            </div>
                        </div>
                        <div class="col-xl-4 clearfix">
                            <div class="float-left">
                                <span class="grey darken-1 block"><b>Jumlah Ujian Aktif</b><br> Telah diaktifkan</span>
                            </div>
                            <div class="float-right">
                                <span class="font-large-3 text-bold-300">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- fitness stats -->
<div class="row match-height">
    <div class="col-xl-8 col-lg-12">
        <div class="card">
            <div class="card-header no-border-bottom">
                <h3>
                  <span class="text-bold-300">Daftar Ujian Aktif</span>
                </h3>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-teal bg-lighten-4">
                                <tr>
                                    <th>#</th>
                                    <th>Kode Ujian</th>
                                    <th>Mapel</th>
                                    <th>Token</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-12">
        <div class="card profile-card-with-cover">
          <div class="card-content">
            <div class="card-image text-center mt-2">
                <img src="../../../app-assets/images/portrait/small/avatar-s-8.png" class="rounded-circle img-border box-shadow-1" alt="Card image">
            </div>
            <div class="mt-2">
                <h3 class="text-center m-2">{{ Auth::user()->name }}</h3>
                <hr class="m-2">
                <div class="ml-2">
                  <li class="mr-2">
                    <span class="font-small-4 text-muted">{{ Auth::user()->email }}</span></li>
                  <li class="mr-2">
                    <span class="font-small-4 text-muted">{{ Auth::user()->hp }}</span></li>
                  <li class="mr-2">
                    <span class="font-small-4 text-muted">Irzam Kasyfillah</span></li>
                  <li class="mr-2">
                    <span class="font-small-4 text-muted">Irzam Kasyfillah</span></li>
                </div>
                <div class="card-body text-center">
                    <a href="{{ route('profile.index') }}" class="btn btn-min-width btn-facebook">Edit Profile</a>
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

    <!-- ////////////////////////////////////////////////////////////////////////////-->
    