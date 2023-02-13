<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" type="image/png" href="{{load_asset('front/img/favicon.png')}}" />
	<title>{{$application_name}} {{$version}} | {{$title}}</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<!-- bootstrap -->
	<link rel="stylesheet" href="{{load_asset('new-assets/plugins/bootstrap/4.0.0/css/bootstrap.min.css')}}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{load_asset('new-assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css')}}">
	<link rel="stylesheet" href="{{load_asset('new-assets/plugins/animate/animate.min.css')}}">
	<!-- Ionicons -->
	<link rel="stylesheet" href="{{load_asset('new-assets/plugins/ionicons/css/ionicons.min.css')}}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{load_asset('new-assets/css/apple/style.min.css')}}">
	<link rel="stylesheet" href="{{load_asset('new-assets/css/apple/custom.css')}}">
	<link rel="stylesheet" href="{{load_asset('new-assets/css/apple/style-responsive.min.css')}}">
	<link rel="stylesheet" href="{{load_asset('new-assets/css/apple/theme/default.css')}}">
	<!-- Pace style -->
	<link rel="stylesheet" href="{{load_asset('new-assets/plugins/pace/pace.min.js')}}">
	<!-- Toaster -->
	<link rel="stylesheet" href="{{load_asset('bower_components/toastr/toastr.min.css')}}">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Google Font -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

	@yield('head')
</head>
<body>
	<!-- <div class="page-container page-sidebar-fixed page-header-fixed gradient-enabled"> -->
	<div id="page-container" class="page-container fade page-sidebar-fixed page-header-fixed show">
		@include('partials.header')
		@include('partials.nav')
	</div>
	@yield('content')
	

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<!-- jQuery 3 -->
<script src="{{load_asset('new-assets/plugins/jquery/jquery-3.2.1.min.js')}}"></script>
<!-- <script src="{{load_asset('bower_components/jquery/dist/jquery.min.js')}}"></script> -->
<!-- Bootstrap 3.3.7 -->
<script src="{{load_asset('new-assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{load_asset('new-assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{load_asset('new-assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{load_asset('new-assets/plugins/js-cookie/js.cookie.js')}}"></script>
<script src="{{load_asset('new-assets/plugins/pace/pace.min.js')}}"></script>
<!-- FastClick -->
<script src="{{load_asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
<!--Toaster-->

<script src="{{load_asset('bower_components/toastr/toastr.min.js')}}"></script>

<!-- AdminLTE App -->

<script src="{{load_asset('new-assets/js/theme/apple.min.js')}}"></script>
<script src="{{load_asset('new-assets/js/apps.min.js')}}"></script>
<!-- <script src="{{load_asset('new-assets/js/apps.min.js')}}"></script> -->
<script src="{{load_asset('new-assets/js/demo/form-plugins.demo.min.js')}}"></script>
<!-- <script src="{{load_asset('dist/js/bayu.js')}}"></script> -->

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
@yield('script')
</body>
</html>
