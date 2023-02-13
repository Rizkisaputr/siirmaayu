<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" type="image/png" href="<?php echo e(load_asset('front/img/favicon.png')); ?>" />
	<title><?php echo e($application_name); ?> <?php echo e($version); ?> | <?php echo e($title); ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 4.0.0 -->
	<link rel="stylesheet" href="<?php echo e(load_asset('new-assets/plugins/bootstrap/4.0.0/css/bootstrap.min.css')); ?>">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo e(load_asset('new-assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(load_asset('new-assets/plugins/animate/animate.min.css')); ?>">
	<!-- Theme style -->
	<!-- <link rel="stylesheet" href="<?php echo e(load_asset('dist/css/AdminLTE.min.css')); ?>"> -->
	<!-- new style -->
	<link rel="stylesheet" href="<?php echo e(load_asset('new-assets/css/default/style.min.css')); ?>">
	<!-- <link rel="stylesheet" href="<?php echo e(load_asset('new-assets/css/default/responsive.min.css')); ?>"> -->
	<link rel="stylesheet" href="<?php echo e(load_asset('new-assets/css/apple/style-responsive.min.css')); ?>">
	<link rel="stylesheet" id="theme" href="<?php echo e(load_asset('new-assets/css/default/theme/default.css')); ?>">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo e(load_asset('new-assets/plugins/pace/pace.min.js')); ?>">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<!-- Google Font -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<?php echo $__env->yieldContent('head'); ?>
</head>
<body class="pace-top bg-white">

<?php echo $__env->yieldContent('body'); ?>

<!-- jQuery 3 -->
<script src="<?php echo e(load_asset('new-assets/plugins/jquery/jquery-3.2.1.min.js')); ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo e(load_asset('new-assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(load_asset('new-assets/plugins/slimscroll/jquery.slimscroll.min.js')); ?>"></script>
<script src="<?php echo e(load_asset('new-assets/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(load_asset('new-assets/plugins/js-cookie/js.cookie.js')); ?>"></script>
<script src="<?php echo e(load_asset('new-assets/js/theme/default.min.js')); ?>"></script>
<script src="<?php echo e(load_asset('new-assets/js/apps.min.js')); ?>"></script>
<!-- iCheck -->
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<?php echo $__env->yieldContent('script'); ?>
</body>
</html>
