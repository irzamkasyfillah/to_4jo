<!-- fixed-top-->
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-static-top navbar-dark bg-blue-grey bg-lighten-1 navbar-border navbar-brand-center">
      <div class="navbar-wrapper">
        <div class="navbar-header">
          <ul class="nav navbar-nav flex-row">
            <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
            <li class="nav-item"><a class="navbar-brand" href="../../../html/ltr/horizontal-top-icon-menu-template/index.html"><img class="brand-logo" alt="robust admin logo" src="../../../app-assets/images/logo/logo-light-sm.png">
                <h3 class="brand-text">Lorem Ipsum</h3></a></li>
            <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a></li>
          </ul>
        </div>
        <div class="navbar-container content">
          <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="nav navbar-nav mr-auto float-left">
              <!-- <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li> -->
            </ul>
            <ul class="nav navbar-nav float-right">
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('home') }}">{{ __('Beranda') }}</a>
              </li>
              <li class="dropdown dropdown-user nav-item">
                  <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                      <span class="nav-link user-name">{{ ucwords(Auth::user()->name) }} <span id="notif1"></span>
                      <input id="id_user" type="text" value="{{Auth::user()->id}}" hidden>
                  </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                        <i class="ft-user"></i> Edit Profil
                    </a>
                    <a class="dropdown-item" href="../../notifikasi/{{Auth::user()->id}}">
                        <i class="ft-mail"></i> Pesan <span id="notif2"></span>
                    </a>
                  <div class="dropdown-divider">

                  </div>
                    <a class="dropdown-item" href="{{ route('logout') }}" 
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                      <i class="ft-power"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
              </li>
              @endguest
            </ul>
          </div>
        </div>
      </div>
    </nav>
    {{-- @if (Auth::user()->id != "") --}}
    {{-- @endif --}}
    <script>
      $(document).ready(function(){
          var id = $('#id_user').val();
          
          $.ajax({
              url: '../../jumlah-notifikasi/'+id,
              datatype: 'json',
              success: function(data){
                  // var obj = JSON.parse(data);
                  // console.log(obj);
                  if (data>0) {
                    $('#notif1').append(`
                    <span class="notif badge badge-pill badge-default badge-danger badge-default badge-up">`+data+`</span>
                    `);
                    $('#notif2').append(`
                    <span class="notif badge badge-pill badge-default badge-danger badge-default">`+data+`</span>
                    `);
                  }
              },
              error: function(data){
                  console.log(data);
              }
          });
      });
  </script>

    <!-- ////////////////////////////////////////////////////////////////////////////-->