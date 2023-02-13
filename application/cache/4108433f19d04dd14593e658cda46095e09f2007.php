 <!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/png" href="<?php echo e(load_asset('front/images/favicon.png')); ?>" />

	<!-- Fonts -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

	<!-- Font Icon -->
	<link rel="stylesheet" href="<?php echo e(load_asset('new-assets/plugins/ionicons/css/ionicons.min.css')); ?>">

	<!-- Style RDS -->
	<link rel="stylesheet" href="<?php echo e(load_asset('front/css/style.minify.css')); ?>" async="async">
	<link rel="stylesheet" href="<?php echo e(load_asset('front/css/custom.css')); ?>">
    <link href="<?php echo base_url()?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js" rel="stylesheet" media="screen">

	<title><?php echo e($application_name); ?> | <?php echo e($title); ?></title>
	<style>
	</style>
</head>
<body>
<!-- old navbar-brand -->
<nav class="navbar navbar-light bg-gradient-aqua">
        <div class="text-center text-black"><font size='3'> <b><?php echo e($application_copyright); ?>    |   <?php echo e($application_name); ?> <?php echo e($version); ?>  |  <i><b small color='#b9ddca'>   <?php echo e($covid); ?> </b></i> |</b> <?php echo e($application_long_name); ?></a></font></div>                             
</nav>
<!-- end old navbar -->

<header class="text-left" style="background:url('<?php echo e(load_asset('front/images/bg-header.jpg')); ?>')">
 		<a class="navbar-brand">
							<img class="mr-3" src="./assets/front/images/logo_psc.png" alt="">
							<img class="mr-3" src="./assets/front/images/logo_indramayu.png" alt="">
							<img class="mr-3" id="onlinestatus" src="./assets/sijariemas/img/sijariemas.png" alt="">
		</a> 
</header>



<?php $__env->startSection('head'); ?>

<style>
	.login-page, .register-page{
		background: linear-gradient(141deg, #ffffff 0%, #ffffff 51%, #ffffff 75%);
	}
	.btn-primary {
		background: linear-gradient(141deg, #ffffff 0%, #ffffff 51%, #ffffff 75%);
	}

	.alert-error {
		background: #eaf7ff; border: 1px solid #eaf7ff; color: #eaf7ff; padding: 2px; margin: 5px 0 2px 0;
	}
</style>

<link rel="stylesheet" href="<?php echo e(load_asset('sijariemas/css/good.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>

<body>
	<div id="formWrapper">
        <div id="form">
            <div class="login-content" align="center"><p class="form-item"><font size='3' color='#000000' ><b>Masukkan e-mail dan password </p></b></font>  
                    	<?php if($message): ?>
                        <div class="alert-error"><?php echo $message; ?></div>
                    	<?php endif; ?>
                    	<?php if($message_ok): ?>
                        <div class="alert-success"><?php echo $message_ok; ?></div>
                    	<?php endif; ?>
                		<?php echo form_open('auth/login'); ?>

                        <div class="form-group m-b-15">
                            <?php echo form_input($identity,'','class="form-control" placeholder="Email, contoh: rspkm_cibatu@gmail.com"'); ?>

                        </div>
                        <div class="form-group m-b-15">
                            <?php echo form_input($password,'','class="form-control" placeholder="Password"'); ?>

                        </div>
                         
                        <div class="login-buttons">
                                <button type="submit" class="btn btn-success btn-block btn-md">MASUK</button>
                                <!--<button type="button" class="btn btn-primary btn-block btn-md" data-toggle="modal" data-target="#modalNakes">
                                    REGISTRASI NAKES <i class="fa fa-angle-double-right"></i></button>-->
                                <br>
                                <button type="button" class="btn btn-link btn-block btn-md" data-toggle="modal" data-target="#modalNakes" class="f-w-500 text-blue">REGISTRASI NAKES MANDIRI</button>
                                     
                                <button type="button" class="btn btn-warning btn-block btn-md"> <a href="<?php echo e(base_url('./dashboard')); ?>" target="_blank" class="f-w-300 text-white"> <b>DASHBOARD PENGGUNAAN SIIRMAAYU </b> </a></button>
                                
                                <button type="button" class="btn btn-danger btn-block btn-md"> <a href="<?php echo e(base_url('./home')); ?>" target="_blank" target="_blank" class="f-w-300 text-white"> <b>DASHBOARD BED / RUANGAN </b></a></button> 
                                
                                <button type="button" class="btn btn-info btn-block btn-md"> <a href="<?php echo e(base_url('./map')); ?>" target="_blank" target="_blank" class="f-w-300 text-white"> <b>PETA FASKES DAN AMBULAN</b></a></button>
                        </div>
                        <br>
                            <p class="text-center text-grey-darker">
                                &copy; 2013-2021 <?php echo e($application_copyright); ?> <br><?php echo e($application_name); ?> <?php echo e($version); ?>

                            </p>
                            <hr>
                         <?php echo form_close(); ?>

                        </div>
 				         <p class="text-center"> Supported by : </p>
                	    <div class="col-lg-12">
                    	<div class="clearfix">
                            		<div class="text-center"><a href="https://siirmaayu.id/" target="_blank"> <img class="width-100 text-center" src="<?php echo e(load_asset('new-assets/img/login-bg/smartrujukan.jpg')); ?>" alt=""></div>
                                                                        <?php
                                    function IPnya() {
                                        $ipaddress = '';
                                        if (getenv('HTTP_CLIENT_IP'))
                                            $ipaddress = getenv('HTTP_CLIENT_IP');
                                        else if(getenv('HTTP_X_FORWARDED_FOR'))
                                            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
                                        else if(getenv('HTTP_X_FORWARDED'))
                                            $ipaddress = getenv('HTTP_X_FORWARDED');
                                        else if(getenv('HTTP_FORWARDED_FOR'))
                                            $ipaddress = getenv('HTTP_FORWARDED_FOR');
                                        else if(getenv('HTTP_FORWARDED'))
                                            $ipaddress = getenv('HTTP_FORWARDED');
                                        else if(getenv('REMOTE_ADDR'))
                                            $ipaddress = getenv('REMOTE_ADDR');
                                        else
                                            $ipaddress = 'IP Tidak Dikenali';
                                     
                                        return $ipaddress;
                                    }
                                    $ipaddress = $_SERVER['REMOTE_ADDR'];
                                    echo "IP anda adalah : ";
                                    echo IPnya();
                                    //echo "<br>Browser ";
                                    //echo $_SERVER['HTTP_USER_AGENT'];
                                    //echo "<br> Sistem Operasi :";
                                    //echo php_uname();
                                    ?> 
                                    
                                    <a class="wa-chat" href="https://api.whatsapp.com/send?phone=6282111502000&amp;text=R%23pmas%23Nama%20Pasien%3A..Umur%3A...th.Suami%3A..Diagnosa%3A...terapi%3A...golongan%20darah%3A..Biaya%2FAsuransi%3A...info%20lainnya%3A...%20perujuk%3A%20Br%2FZr%2FDr..." target="_blank" rel="nofollow noopener noreferrer">
                                    <div class="wa-image-container"><img class="wa-image" src="<?php echo e(load_asset('new-assets/img/login-bg/4a376104.svg')); ?>" alt="whatsapp-smartrujukan"></div>
                                    <span class="wa-text">Rujuk via WHATSAPP GATEWAY</span></a></div></div>

     					<div class="modal fade" id="modalNakes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Tenaga Kesehatan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel -panel-inverse">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
               </div>
            </div>
        </div> 
<?php $__env->stopSection(); ?>
 

<?php $__env->startSection('script'); ?>
    <!-- InputMask -->
    <script src="<?php echo e(load_asset('bower_components/select2/dist/js/select2.full.min.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2-default').select2();
            $('#form_nakes').submit(function() {
                $('.btn-save').attr('disabled','disabled');
            });
        });
    </script>
<?php $__env->stopSection(); ?>

</body>

</html>
<?php echo $__env->make('layouts.full_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>