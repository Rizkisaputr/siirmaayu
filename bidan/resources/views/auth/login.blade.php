<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ env('APP_NAME') }}</title>
<!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') }}"></script>
      <![endif]-->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
<meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
<meta name="author" content="colorlib" />
<link rel="icon" href="{{ asset(env('APP_BASE').'vendor/admindek/assets/images/favicon.ico') }}" type="image/x-icon">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset(env('APP_BASE').'vendor/admindek/bower_components/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset(env('APP_BASE').'vendor/admindek/assets/pages/waves/css/waves.min.css') }}" type="text/css" media="all"> <link rel="stylesheet" type="text/css" href="{{ asset(env('APP_BASE').'vendor/admindek/assets/icon/feather/css/feather.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset(env('APP_BASE').'vendor/admindek/assets/icon/themify-icons/themify-icons.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset(env('APP_BASE').'vendor/admindek/assets/icon/icofont/css/icofont.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset(env('APP_BASE').'vendor/admindek/assets/icon/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset(env('APP_BASE').'vendor/admindek/assets/css/style.css') }}"><link rel="stylesheet" type="text/css" href="{{ asset(env('APP_BASE').'vendor/admindek/assets/css/pages.css') }}">
<style>
  .logo { filter: invert(0.8); width: 200px; }
  .background { width: 100%; height: 300px; overflow: hidden; z-index: -1; position: absolute; top: 0; left: 0}
</style>
</head>
<body themebg-pattern="theme2">
<div class="background">
  <img src="{{ asset(env('APP_BASE').'img/background.png') }}" width="100%">
</div>
<div class="theme-loader">
<div class="loader-track">
<div class="preloader-wrapper">
<div class="spinner-layer spinner-blue">
<div class="circle-clipper left">
<div class="circle"></div>
</div>
<div class="gap-patch">
<div class="circle"></div>
</div>
<div class="circle-clipper right">
<div class="circle"></div>
</div>
</div>
<div class="spinner-layer spinner-red">
<div class="circle-clipper left">
<div class="circle"></div>
</div>
<div class="gap-patch">
<div class="circle"></div>
</div>
<div class="circle-clipper right">
<div class="circle"></div>
</div>
</div>
<div class="spinner-layer spinner-yellow">
<div class="circle-clipper left">
<div class="circle"></div>
</div>
<div class="gap-patch">
<div class="circle"></div>
</div>
<div class="circle-clipper right">
<div class="circle"></div>
</div>
</div>
<div class="spinner-layer spinner-green">
<div class="circle-clipper left">
<div class="circle"></div>
</div>
<div class="gap-patch">
<div class="circle"></div>
</div>
<div class="circle-clipper right">
<div class="circle"></div>
</div>
</div>
</div>
</div>
</div>
<section class="login-block">
<div class="container-fluid">
<div class="row">
<div class="col-sm-12">
  <form method="POST" action="{{ route('login') }}" class="md-float-material form-material">
    @csrf

<div class="auth-box card">
<div class="card-block">
<div class="row m-b-20">
<div class="col-md-12">
  <div class="text-center">
  <img src="{{ asset(env('APP_BASE').'img/logo.png') }}" class="logo" alt="Kohort">
  </div>
{{--<h3 class="text-center txt-primary">Kohort</h3>--}}
</div>
</div>

<p class="text-muted text-center p-b-5">Masukkan Username &amp; Password</p>
<div class="form-group form-primary">
<input type="text" name="username" class="form-control" required="">
<span class="form-bar"></span>
<label class="float-label">Username</label>
</div>
<div class="form-group form-primary">
<input type="password" name="password" class="form-control" required="">
<span class="form-bar"></span>
<label class="float-label">Password</label>
</div>
<div class="row m-t-30">
<div class="col-md-12">
<button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">LOGIN</button>
</div>
</div>
</div>
</div>
</form>
<div class="text-center text-muted p-10">&copy; 2021. Dinkes Kab. Indramayu. Alright Reserved.
</div>
</div>
</div>
</div>
</section>
<!--[if lt IE 10]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
<script type="text/javascript" src="{{ asset(env('APP_BASE').'vendor/admindek/bower_components/jquery/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset(env('APP_BASE').'vendor/admindek/bower_components/jquery-ui/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset(env('APP_BASE').'vendor/admindek/bower_components/popper.js/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset(env('APP_BASE').'vendor/admindek/bower_components/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset(env('APP_BASE').'vendor/admindek/assets/pages/waves/js/waves.min.js') }}"></script>
<script type="text/javascript" src="{{ asset(env('APP_BASE').'vendor/admindek/bower_components/jquery-slimscroll/js/jquery.slimscroll.js') }}"></script>
<script type="text/javascript" src="{{ asset(env('APP_BASE').'vendor/admindek/bower_components/modernizr/js/modernizr.js') }}"></script>
<script type="text/javascript" src="{{ asset(env('APP_BASE').'vendor/admindek/bower_components/modernizr/js/css-scrollbars.js') }}"></script>
<script type="text/javascript" src="{{ asset(env('APP_BASE').'vendor/admindek/assets/js/common-pages.js') }}"></script>

</body>
</html>
