<nav class="navbar header-navbar pcoded-header" header-theme="themelight1">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <img src="{{asset('img/psc_siirmaayu.png')}}" alt="SI-IRMA-AYU" height="75" />
            <p>DASHBOARD SI-IRMA-AYU<br><span>KABUPATEN INDRAMAYU</span></p>

            <a class="mobile-menu" id="mobile-collapse" href="#!">

            <a class="mobile-options waves-effect waves-light">
            <i class="feather icon-more-horizontal"></i>
            </a>
        </div>
        <div class="navbar-container">
            <div class="float-right m-15">
                <button class="btn btn-round btn-warning m-r-10 btn-cetak" onclick="return generateChart(this)" disabled="disabled"> ... </button>
                <button class="btn btn-round btn-success m-r-10 btn-excel" onclick="return generateExcel()" disabled="disabled"> ... </button>
                <a href="{{ url('https://siirmaayu.id/auth/login')}}" target="_blank">
                  <button class="btn btn-round btn-primary" ><i class="feather icon-airplay"></i>
                  SI-IRMA-AYU</button></a>
            </div>
        </div>
    </div>
</nav>
<div>
