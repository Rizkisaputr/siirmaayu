<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description"
            content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
        <meta name="keywords"
            content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
        <meta name="author" content="colorlib" />

        <title>@yield('title', 'SiAyu Bidan')</title>

        <link rel="icon" href="{{ asset(env('APP_BASE').'img/favicon.ico')}}" type="image/x-icon">

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_BASE').'vendor/admindek/bower_components/bootstrap/css/bootstrap.min.css')}}">

        <link rel="stylesheet" href="{{ asset(env('APP_BASE').'vendor/admindek/assets/pages/waves/css/waves.min.css')}}" type="text/css" media="all">

        <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_BASE').'vendor/admindek/assets/icon/feather/css/feather.css')}}">

        <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_BASE').'vendor/admindek/assets/css/font-awesome-n.min.css')}}">

        <link rel="stylesheet" href="{{ asset(env('APP_BASE').'vendor/admindek/bower_components/chartist/css/chartist.css')}}" type="text/css" media="all">
        <link rel="stylesheet" href="{{ asset(env('APP_BASE').'vendor/admindek/bower_components/select2/dist/css/select2.min.css')}}" type="text/css" media="all">

        <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_BASE').'vendor/admindek/assets/css/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_BASE').'vendor/admindek/assets/css/widget.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_BASE').'plugins/sweetalert/css/sweetalert.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_BASE').'plugins/notification/notification.css') }}">
        @yield('css')

        <style>
        .navbar-logo { color: #fff; text-align: left !important;line-height: 12px; position: relative;}
        .navbar-logo p {  font-size: 1.1em !important; padding-left: 50px; margin-top: 5px }
        .navbar-logo img{ padding-right: 20px; position: absolute; top: 12px; left: 15px; filter: invert(1) }
        .navbar-logo span { font-size: 80% }

        .btn .feather { color: #fff !important }
        .btn-sm { font-size: 1.1em; }
        .pull-right { float: right }
        .pull-left { float: left }
        .clearfix { clear: both }
        .breadcrumb { margin: 0 0 10px 0; padding: 0; background: none; }
        .btn { padding: 5px 10px; }
        .btn-create .feather { margin: 0; }

        .table td, .table th { font-size: .9em}
        .input-group { margin-bottom: 0px !important }
        .flatpickr-input .form-control[readonly] { background-color: #fff !important; }
        .icon-only { margin-right: 0 !important}
        </style>
    </head>

    <body>

        <div class="loader-bg">
            <div class="loader-bar"></div>
        </div>

        <div id="pcoded" class="pcoded">
          <div id="pcoded" class="pcoded iscollapsed" nav-type="st2" theme-layout="vertical" vertical-placement="left" vertical-layout="wide" pcoded-device-type="desktop" vertical-nav-type="expanded" vertical-effect="shrink" vnavigation-view="view1" fream-type="theme1" layout-type="light">
          			<div class="pcoded-overlay-box"></div>
          			<div class="pcoded-container navbar-wrapper">
          				@include('layouts.navbar')

          				<div class="pcoded-main-container" style="margin-top: 70.4px;">
          					<div class="pcoded-wrapper">
          						<!-- [ navigation menu ] start -->
          						@include('layouts.sidebar')
                      @yield('body')
                    </div>
          				</div>
          			</div>
          		</div>
        </div>
        <!--Scripts JS-->
        <script src="{{ asset(env('APP_BASE').'js/app.js')}}"></script>
        <script src="{{ asset(env('APP_BASE').'vendor/admindek/bower_components/jquery/js/jquery.min.js')}}"></script>
        <script src="{{ asset(env('APP_BASE').'vendor/admindek/bower_components/jquery-ui/js/jquery-ui.min.js')}}"></script>
        <script src="{{ asset(env('APP_BASE').'vendor/admindek/bower_components/popper.js/js/popper.min.js')}}"></script>
        <script src="{{ asset(env('APP_BASE').'vendor/admindek/bower_components/bootstrap/js/bootstrap.min.js')}}"></script>

        <script src="{{ asset(env('APP_BASE').'vendor/admindek/assets/pages/waves/js/waves.min.js')}}" ></script>

        <script src="{{ asset(env('APP_BASE').'vendor/admindek/bower_components/jquery-slimscroll/js/jquery.slimscroll.js')}}"></script>

        <script src="{{ asset(env('APP_BASE').'vendor/admindek/assets/pages/chart/float/jquery.flot.js')}}" ></script>
        <script src="{{ asset(env('APP_BASE').'vendor/admindek/assets/pages/chart/float/jquery.flot.categories.js')}}" ></script>
        <script src="{{ asset(env('APP_BASE').'vendor/admindek/assets/pages/chart/float/curvedLines.js')}}" ></script>
        <script src="{{ asset(env('APP_BASE').'vendor/admindek/assets/pages/chart/float/jquery.flot.tooltip.min.js')}}" ></script>

        <script src="{{ asset(env('APP_BASE').'vendor/admindek/bower_components/chartist/js/chartist.js')}}" ></script>
        <script src="{{ asset(env('APP_BASE').'vendor/admindek/bower_components/select2/dist/js/select2.min.js')}}" ></script>

        <script src="{{ asset(env('APP_BASE').'vendor/admindek/assets/pages/widget/amchart/amcharts.js')}}" ></script>
        <script src="{{ asset(env('APP_BASE').'vendor/admindek/assets/pages/widget/amchart/serial.js')}}" ></script>
        <script src="{{ asset(env('APP_BASE').'vendor/admindek/assets/pages/widget/amchart/light.js')}}" ></script>

        <script src="{{ asset(env('APP_BASE').'vendor/admindek/assets/js/pcoded.min.js')}}" ></script>
        <script src="{{ asset(env('APP_BASE').'vendor/admindek/assets/js/vertical/vertical-layout.min.js')}}" ></script>
        <script src="{{ asset(env('APP_BASE').'vendor/admindek/assets/pages/dashboard/custom-dashboard.min.js')}}"></script>
        <script src="{{ asset(env('APP_BASE').'vendor/admindek/assets/js/script.min.js')}}"></script>
        <script src="{{ asset(env('APP_BASE').'vendor/admindek/assets/js/jquery.mask.js')}}"></script>
        <script src="{{ asset(env('APP_BASE').'vendor/admindek/assets/js/bootstrap-filestyle.js')}}"></script>
        <script src="{{ asset(env('APP_BASE').'vendor/admindek/assets/js/bootstrap-growl.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset(env('APP_BASE').'plugins/sweetalert/js/sweetalert.min.js') }}"></script>
        <script src="{{ asset(env('APP_BASE').'js/custom.js')}}"></script>

        @yield('script')
    </body>
</html>
