<!-- [ Header ] start -->
<nav class="navbar header-navbar pcoded-header iscollapsed" header-theme="themelight1" pcoded-header-position="fixed">
  <div class="navbar-wrapper">
    <div class="navbar-logo" logo-theme="theme6">
      <a href="index.html">
        <img class="img-fluid" src="{{ asset('img/logo.png') }}" alt="Theme-Logo" style="height: 40px">
      </a>
      <a class="mobile-menu" id="mobile-collapse" href="#!">
        <i class="feather icon-menu icon-toggle-right"></i>
      </a>
      <a class="mobile-options waves-effect waves-light">
        <i class="feather icon-more-horizontal"></i>
      </a>
    </div>
    <div class="navbar-container container-fluid">
      <ul class="nav-left">
        <li>
          <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
            <i class="full-screen feather icon-maximize"></i>
          </a>
        </li>
      </ul>
      <ul class="nav-right">

         <li class="user-profile header-notification">

          <div class="dropdown-primary dropdown">
            <div class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('img/user.png') }}" class="img-radius" alt="User-Profile-Image">
              <span>{{ Auth::user()->name }}</span>
              <i class="feather icon-chevron-down"></i>
            </div>
            <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
              <li>
                <a href="#">
                  <i class="feather icon-user"></i> Profile
                </a>
              </li>
              <li onclick="return logout()">
                <form method="POST" action="{{ route('logout') }}" id="logoutBtn">
                @csrf
                <a onclick="$(this).parent().submit()">
                  <i class="feather icon-log-out"></i> Logout
                </a>
                </form>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- [ Header ] end -->
