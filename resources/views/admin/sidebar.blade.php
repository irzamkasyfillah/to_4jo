<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
      <div class="main-menu-content">
        
          <img width="100%" src="{{asset('/uploads/4jo.png')}}" class="" alt="Card image">
          <hr class="m-0">
        
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
           @if (Request::segment(1) == "home" || Request::segment(1) == "")
            <li class="active nav-item">
          @else
            <li class=" nav-item">
          @endif
              <a href="{{ route('home') }}"><i class="fa fa-home">
              </i><span class="menu-title" data-i18n="nav.dash.main">Dashboard</span></a>
            </li>
            <hr class="m-0">
            
          @if (Request::segment(1) == "soal" )
            <li class="active nav-item">
          @else
            <li class=" nav-item">
          @endif
              <a href=""><i class="fa fa-book"></i><span class="menu-title" data-i18n="nav.templates.main">Bank Soal</span></a>
              <ul class="menu-content">
                <li><a class="menu-item" href="../../soal/kategori/tps" data-i18n="nav.templates.vert.main">TPS</a>
                </li>
                <li><a class="menu-item" href="../../soal/kategori/saintek" data-i18n="nav.templates.vert.main">TKA SAINTEK</a>
                </li>
                <li><a class="menu-item" href="../../soal/kategori/soshum" data-i18n="nav.templates.vert.main">TKA SOSHUM</a>
                </li>
            </ul>
          </li>
          <hr class="m-0">
            
          @if (Request::segment(1) == "data-tryout" || Request::segment(1) == "tryout" )
            <li class="active nav-item">
          @else
            <li class=" nav-item">
          @endif
              <a href=""><i class="fa fa-pencil-square-o"></i><span class="menu-title" >Try Out</span></a>
              <ul class="menu-content">
                <li><a class="menu-item" href="{{ route('data-tryout.index') }}" data-i18n="nav.templates.vert.main">Daftar Try Out</a>
                </li>
                <li><a class="menu-item" href="../../tryout/konfirmasi-peserta" data-i18n="nav.templates.vert.main">Daftar Konfirmasi Peserta</a>
                </li>
                <li><a class="menu-item" href="{{ route('peserta.dikonfirmasi') }}" data-i18n="nav.templates.vert.main">Daftar Peserta Dikonfirmasi</a>
                </li>
                <li><a class="menu-item" href="{{ route('history-try-out.index')}}" data-i18n="nav.templates.vert.main">History Try Out</a>
                </li>
            </ul>
          </li>
          <hr class="m-0">
          
          <?php 
            $segment = array('setting-pembayaran', 'setting-peraturan-try-out', 'setting-waktu-pengerjaan-subtes')
          ?>
          @if (in_array(Request::segment(1), $segment) )
            <li class="active nav-item">
          @else
            <li class=" nav-item">
          @endif
              <a href="#"><i class="fa fa-cogs"></i><span class="menu-title" data-i18n="nav.templates.main">Setting TO</span></a>
              <ul class="menu-content">
                <li><a class="menu-item" href="{{ route('setting-pembayaran.index') }}" data-i18n="nav.templates.vert.main">Pembayaran</a>
                </li>
                <li><a class="menu-item" href="{{ route('setting-peraturan-try-out.index') }}" data-i18n="nav.templates.vert.main">Peraturan Try Out</a>
                </li>
                <li><a class="menu-item" href="{{ route('setting-waktu-pengerjaan-subtes.index') }}" data-i18n="nav.templates.vert.main">Waktu Pengerjaan Subtes</a>
                </li>
              </ul>
          </li>
          <hr class="m-0">

          @if (Request::segment(1) == "kupon" )
            <li class="active nav-item">
          @else
            <li class="nav-item">
          @endif
              <a href="{{route('kupon.index')}}"><i class="fa fa-percent"></i><span class="menu-title" data-i18n="nav.templates.main">Kupon</span></a>
              {{-- <ul class="menu-content">
                <li><a class="menu-item" href="#" data-i18n="nav.templates.vert.main">1</a>
                </li>
                <li><a class="menu-item" href="#" data-i18n="nav.templates.vert.main">2</a>
                </li>
                <li><a class="menu-item" href="#" data-i18n="nav.templates.vert.main">3</a>
                </li>
                <li><a class="menu-item" href="#" data-i18n="nav.templates.vert.main">4</a>
                </li>
              </ul> --}}
          </li>
          <hr class="m-0">

          @if (Request::segment(1) == "user" )
            <li class="active nav-item">
          @else
            <li class=" nav-item">
          @endif
              <a href="{{ route('user.index') }}"><i class="fa fa-user"></i><span class="menu-title" data-i18n="nav.templates.main">User</span></a>
              {{-- <ul class="menu-content">
                <li><a class="menu-item" href="#" data-i18n="nav.templates.vert.main">1</a>
                </li>
                <li><a class="menu-item" href="#" data-i18n="nav.templates.vert.main">2</a>
                </li>
                <li><a class="menu-item" href="#" data-i18n="nav.templates.vert.main">3</a>
                </li>
                <li><a class="menu-item" href="#" data-i18n="nav.templates.vert.main">4</a>
                </li>
              </ul> --}}
            </li>
          <hr class="m-0">
        </ul>
      </div>
    </div>