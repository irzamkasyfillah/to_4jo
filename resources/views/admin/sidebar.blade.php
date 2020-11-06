<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          @if (Request::segment(1) == "home" || Request::segment(1) == "")
            <li class="active nav-item">
          @else
            <li class=" nav-item">
          @endif
              <a href="{{ route('home') }}"><i class="icon-home">
              </i><span class="menu-title" data-i18n="nav.dash.main">Dashboard</span></a>
            </li>

          @if (Request::segment(1) == "data-tryout" )
            <li class="active nav-item">
          @else
            <li class=" nav-item">
          @endif
              <a href="#"><i class="icon-note"></i><span class="menu-title" data-i18n="nav.templates.main">Try Out</span></a>
              <ul class="menu-content">
                <li><a class="menu-item" href="{{ route('data-tryout.index') }}" data-i18n="nav.templates.vert.main">List Try Out</a>
                </li>
                <li><a class="menu-item" href="tryout/konfirmasi-peserta" data-i18n="nav.templates.vert.main">List Konfirmasi Peserta</a>
                </li>
                <li><a class="menu-item" href="#" data-i18n="nav.templates.vert.main">3</a>
                </li>
            </ul>
          </li>

          @if (Request::segment(1) == "soal" )
            <li class="active nav-item">
          @else
            <li class=" nav-item">
          @endif
              <a href="#"><i class="icon-note"></i><span class="menu-title" data-i18n="nav.templates.main">Bank Soal</span></a>
              <ul class="menu-content">
                <li><a class="menu-item" href="../../soal/kategori/tps" data-i18n="nav.templates.vert.main">TPS</a>
                </li>
                <li><a class="menu-item" href="../../soal/kategori/saintek" data-i18n="nav.templates.vert.main">TKA SAINTEK</a>
                </li>
                <li><a class="menu-item" href="../../soal/kategori/soshum" data-i18n="nav.templates.vert.main">TKA SOSHUM</a>
                </li>
            </ul>
          </li>

          @if (Request::segment(1) == "cetak" )
            <li class="active nav-item">
          @else
            <li class=" nav-item">
          @endif
              <a href=""><i class="icon-note"></i><span class="menu-title" data-i18n="nav.templates.main">Cetak</span></a>
              <ul class="menu-content">
                <li><a class="menu-item" href="#" data-i18n="nav.templates.vert.main">1</a>
                </li>
                <li><a class="menu-item" href="#" data-i18n="nav.templates.vert.main">2</a>
                </li>
                <li><a class="menu-item" href="#" data-i18n="nav.templates.vert.main">3</a>
                </li>
                <li><a class="menu-item" href="#" data-i18n="nav.templates.vert.main">4</a>
                </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>