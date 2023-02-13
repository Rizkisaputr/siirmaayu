<nav class="pcoded-navbar" navbar-theme="theme1" active-item-theme="theme1" sub-item-theme="theme2" active-item-style="style0" pcoded-navbar-position="fixed">
  <div class="nav-list">
    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: 100%; height: 100%;"><div class="pcoded-inner-navbar main-menu" style="overflow: hidden; width: 100%; height: 100%;">

      <ul class="pcoded-item pcoded-left-item" item-border="true" item-border-style="solid" subitem-border="false">
        <li class="@if (request()->is('dashboard*')) active @endif">
          <a href="{{ route('dashboard') }}" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="feather icon-home"></i></span>
            <span class="pcoded-mtext">Dashboard</span>
          </a>
        </li>
        <li class="pcoded-hasmenu @if(request()->is('user*')) active @endif" dropdown-icon="style1" subitem-icon="style1">
          <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="feather icon-settings"></i></span>
            <span class="pcoded-mtext">Pengaturan</span>
          </a>
          <ul class="pcoded-submenu" @if (request()->is('user*')) style="display: block" @endif>
            @foreach(array('user') as $a)
            <li class="{{ (request()->is($a.'*')) ? 'active' : '' }}">
              <a href="{{ route($a) }}" class="waves-effect waves-dark">
                <span class="pcoded-mtext">{{ ucfirst($a) }}</span>
              </a>
            </li>
            @endforeach
          </ul>
        </li>
        <li class="pcoded-hasmenu @if (request()->is(['provinsi*','kabupaten*','kecamatan*','desa*','puskesmas*','posyandu*','bidan*','kader*'])) active @endif" dropdown-icon="style1" subitem-icon="style1">
          <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
            <span class="pcoded-mtext">Referensi</span>
          </a>
          <ul class="pcoded-submenu" @if (request()->is(['provinsi*','kabupaten*','kecamatan*','desa*','puskesmas*','posyandu*','bidan*','kader*'])) style="display: block" @endif>
            @foreach(array('provinsi','kabupaten','kecamatan','desa','puskesmas','posyandu','bidan','kader') as $a)
            <li class="@if (request()->is($a.'*')) active @endif">
              <a href="{{ route($a) }}" class="waves-effect waves-dark">
                <span class="pcoded-mtext">{{ ucfirst($a) }}</span>
              </a>
            </li>
            @endforeach
          </ul>
        </li>
        <li class="@if (request()->is('pws/target*')) active @endif">
          <a href="{{ route('target') }}" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="feather icon-file"></i></span>
            <span class="pcoded-mtext">Target</span>
          </a>
        </li>
        <li class="@if (request()->is('ibu*')) active @endif">
          <a href="{{ route('ibu') }}" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="feather icon-user"></i></span>
            <span class="pcoded-mtext">Ibu</span>
          </a>
        </li>
        <li class="pcoded-hasmenu" dropdown-icon="style1" subitem-icon="style1">
          <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="feather icon-file-text"></i></span>
            <span class="pcoded-mtext">Laporan</span>
          </a>
          <ul class="pcoded-submenu">
            @foreach(array('pws') as $a)
            <li class="@if (request()->is($a.'*')) active @endif">
              <a href="{{ route($a) }}" class="waves-effect waves-dark">
                <span class="pcoded-mtext">@if ($a == "pws") PWS @else{{ ucfirst($a) }}@endif</span>
              </a>
            </li>
            @endforeach
          </ul>
        </li>
      </ul>
    </div><div class="slimScrollBar" style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; width: 5px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 30px;"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div></div>
  </div>
</nav>
