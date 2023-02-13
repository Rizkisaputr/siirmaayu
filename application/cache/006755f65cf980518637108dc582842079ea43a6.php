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
	<link href="<?php echo base_url()?>assets/bower_components/bootstrap-datepicker/bootstrap-datepicker.js" rel="stylesheet" media="screen">

	<title><?php echo e($application_name); ?> <?php echo e($version); ?> | <?php echo e($title); ?></title>

	<style>
	</style>
</head>
<body>

<header class="text-center" style="background:url('<?php echo e(load_asset('')); ?>')">

</header>

<section class="container p-2 card mb-2 tables">
	<div class="row">
		<div class="col-sm-12">
			<!-- old navbar-brand -->
				<nav class="navbar navbar-light bg-white justify-content-between">
					<div class="container">
						<a class="navbar-brand">
							<img class="mr-3" src="./assets/front/images/logo_psc.png" alt="">
							<img class="mr-3" src="./assets/front/images/logo_kabupaten.png" alt="">
							<img class="mr-3" id="onlinestatus" src="./assets/sijariemas/img/sijariemas.png" alt="">
						</a>
							<h4 align="center"><b><font size='4' color='#16a085'>DASHBOARD SIIRMAAYU : Ketersediaan Ruangan dan Dokter <br> Dinas Kesehatan Kabupaten Indramayu</font></b></h4>

							<div class="live"> <div class="live-animate"><div style="width:12px; height:12px"></div></div>
							<h5 style="font-size: 15px;">Live Update</h5>
							</div>

						<form method="GET" action="<?php echo e(base_url('./dashboard/')); ?>" target="_blank">
							<button class="btn btn-round btn-danger"></span>BUKA DASHBOARD PENGGUNAAN SIIRMAAYU</button>
						</form>
						<form class="form-inline" method="GET" action="<?php echo e(base_url('auth/login')); ?>" target="_blank">
							<button class="btn btn-round btn-success" type="submit"><span class="lnr lnr-lock"></span>LOGIN SIIRMAAYU</button>
						</form>
				 
					</div>
				</nav>
				<!-- end old navbar -->
 
		</div>
			<div class="col-sm-12" style="margin-right: 0!important; margin-left: 0!important;">
			<div class="table-responsive">
				<table class="table table-bordered font-12">
					<thead class="thead-dark">
					<tr>
						<!-- <th rowspan="3">#</th> -->
						<th rowspan="3">Rumah Sakit</th>
						<!-- <th rowspan="3">Telepon</th> -->
						<th colspan="3">Kelas I</th>
						<th colspan="3">Kelas II</th>
						<th colspan="3">Kelas III</th>
						<!--<th colspan="3">VIP</th>
						<th colspan="3">VVIP</th>
						<th rowspan="3">IGD</th>
						<th rowspan="3">PONEK</th>
						<th rowspan="3">NIFAS</th>
						<th rowspan="3">PERI</th>-->
						<th rowspan="3">VK</th>					
						<th rowspan="3">ICU</th>
						<th rowspan="3">HCU</th>
						<th rowspan="3">NICU</th>				
						<th rowspan="3">PICU</th>
						<th colspan="2">ICU Tekanan Negatif Dengan Ventilator</th>
						<th colspan="2">ICU Tekanan Negatif Tanpa Ventilator</th>
						<th colspan="2">ICU Tanpa Tekanan Negatif dengan Ventilator</th>
						<th colspan="2">ICU Tanpa Tekanan Negatif tanpa Ventilator</th>
						<th colspan="2">Isolasi Tekanan Negatif</th>						
						<th colspan="2">Isolasi Tanpa Tekanan Negatif</th>
						<th colspan="2">NICU khusus COVID-19</th>
						<th colspan="2">Perina khusus COVID-19</th>				
						<th colspan="2">PICU khusus COVID-19</th>
						<th colspan="2">OK khusus COVID-19</th>
						<th colspan="2">HD khusus COVID-19</th>
						<!--<th rowspan="3">VENTI<br>LATOR</th>-->						
						<th rowspan="3">RUJUKAN<br>BLM DIRESPON</th>
						<th rowspan="3">Ambu<br>lan</th>
						<th colspan="7">Dokter Spesialis On-Site</th>
						<th rowspan="3">Update <br> Bed <br> Terakhir</th>
					</tr>
					<tr>
						<th rowspan="2">KPS</th>
						<th colspan="2">TSD</th>
						<th rowspan="2">KPS</th>
						<th colspan="2">TSD</th>
						<th rowspan="2">KPS</th>
						<th colspan="2">TSD</th>

						<th rowspan="2">KPS</th>
						<th rowspan="2">TSD</th>
						<th rowspan="2">KPS</th>
						<th rowspan="2">TSD</th>
						<th rowspan="2">KPS</th>
						<th rowspan="2">TSD</th>
						<th rowspan="2">KPS</th>
						<th rowspan="2">TSD</th>
						<th rowspan="2">KPS</th>
						<th rowspan="2">TSD</th>
						<th rowspan="2">KPS</th>
						<th rowspan="2">TSD</th>
						<th rowspan="2">KPS</th>
						<th rowspan="2">TSD</th>
						<th rowspan="2">KPS</th>
						<th rowspan="2">TSD</th>	
						<th rowspan="2">KPS</th>
						<th rowspan="2">TSD</th>
						<th rowspan="2">KPS</th>
						<th rowspan="2">TSD</th>
						<th rowspan="2">KPS</th>
						<th rowspan="2">TSD</th>

						<!-- untuk VIP dan VVIP
						<th rowspan="2">KPS</th>
						<th colspan="2">Kosong</th>
						<th rowspan="2">KPS</th>
						<th colspan="2">Kosong</th>-->
						<th rowspan="2">Total <br>Siap</th>
						<th rowspan="2">Sp.OG</th>
						<th rowspan="2">Sp.A</th>
						<th rowspan="2">Sp.PD</th>
						<th rowspan="2">Sp.JP</th>
						<th rowspan="2">Sp.P</th>
						<th rowspan="2">Sp.An</th>
					</tr>
					<tr>
						<th>L</th>
						<th>P</th>
						<th>L</th>
						<th>P</th>
						<th>L</th>
						<th>P</th>
						<!-- untuk VIP dan VVIP
						<th>L</th>
						<th>P</th>
						<th>L</th>
						<th>P</th>-->
					</tr>
					<!-- <tr>
						<th>Jaga</th>
						<th>Spesialis</th>
					</tr> -->
					</thead>
					<tbody id="list_bed1">
				
					</tbody>
					<tbody id="list_bed2" style="display: none">
				
					</tbody>
				</table>
				<div class="pull-left info">
		          <i style="color: red; font-size: 11px!important;"><b>KPS (Kapasitas) /</i>
		          <i style="color: red; font-size: 11px!important;">L (Laki-laki) /</i>
		          <i style="color: red; font-size: 11px!important;">P (Perempuan),</i>
		          <i style="color: red; font-size: 11px!important;"><b>TSD. (Tersedia)</b>,</i>
		          <i style="color: red; font-size: 11px!important;">Amb. (Ambulace),</i>
		          <i style="color: red; font-size: 11px!important;">Sp. (Spesialis)</i>
				  <i style="color: blue; font-size: 11px!important;">. Data diatas bersifat indikatif, untuk kepastian mohon hubungi call center 119</i>
		        </div>
			</div>
		</div>
	</div>
	<input type="hidden" id="list_status" value="1">
</section>


<footer class="m-2 text-center">
	<p style="font-size: 14px;">Copyright © 2013-2021 <?php echo e($application_copyright); ?></p>
</footer>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel" style="font-size: 14px;">Detail Bed Dokter & Layanan Kesehatan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="detail-rs" class="modal-body">
			</div>
			<div class="modal-footer">
				<p class="text-right mb-0" style="font-size: 14px;">© 2013-2021 <?php echo e($application_copyright); ?></p>
			</div>
		</div>
	</div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php echo e(load_asset('front/js/jquery-3.3.1.min.js')); ?>"></script>
<script src="<?php echo e(load_asset('front/js/bootstrap.bundle.min.js')); ?>"></script>
<script type="text/javascript">
	$(function(){
		refresh_bed();
		//refresh_sms();
		$('#exampleModal').on('show.bs.modal',function(event){
			var idrs=$(event.relatedTarget).attr('data-idrs');
			$('#detail-rs').html('Loading');
			$('#detail-rs').load("<?php echo e(base_url('home/rs_detil')); ?>/"+idrs,'',function(res,stat,xhr){
				console.log(res,stat,xhr);
			});
		});
		refresh_wa();
		$('#exampleModal').on('show.bs.modal',function(event){
			var idrs=$(event.relatedTarget).attr('data-idrs');
			$('#detail-rs').html('Loading');
			$('#detail-rs').load("<?php echo e(base_url('home/rs_detil')); ?>/"+idrs,'',function(res,stat,xhr){
				console.log(res,stat,xhr);
			});
		});
		//maps
		var center = {
			lat: -7.084805,
			lng: 106.5186523
		};
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 12,
			center: center,
			styles: [{
				"stylers":[{"hue":"#007fff"},{"saturation":89}]},{"featureType":"water","stylers":[{"color":"#ffffff"}]},{"featureType":"administrative.country","elementType":"labels","stylers":[{"visibility":"off"}]
			}]
		});
		var infowindow = new google.maps.InfoWindow({});
		var markerIcon = {
			url: 'https://image.flaticon.com/icons/svg/119/119065.svg',
			scaledSize: new google.maps.Size(40, 40),
			origin: new google.maps.Point(0, 0), // used if icon is a part of sprite, indicates image position in sprite
			anchor: new google.maps.Point(10,20) // lets offset the marker image
		};
		
		var ambulanceIcon = {
			url: 'https://image.flaticon.com/icons/svg/119/119083.svg',
			scaledSize: new google.maps.Size(40, 40),
			origin: new google.maps.Point(0, 0), // used if icon is a part of sprite, indicates image position in sprite
			anchor: new google.maps.Point(10,20) // lets offset the marker image
		};
		
		var marker, count;
		$.get('<?php echo e(base_url('home/rs_map')); ?>',function(res){
			console.log(res);
			for(count = 0; count < res.length; count++){
				marker = new google.maps.Marker({
					icon: markerIcon,
					position: new google.maps.LatLng(res[count].pos_lat, res[count].pos_lon),
					map: map,
					title: res[count].nama
				});
				google.maps.event.addListener(marker, 'click', (function (marker, count) {
					return function () {
						infowindow.setContent(format_window(res[count]));
						infowindow.open(map, marker);
					}
				})(marker, count));
			}
		});

		var repeat_ambulance = 0;

		setInterval(function() {
			<?php $__currentLoopData = $ambulance->result(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $no => $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

			if (parseInt(repeat_ambulance) > 0) ambulance<?php echo e($no); ?>.setMap(null);
			
			$.ajax({
				type: "GET",
				url:'<?php echo e($a->api); ?>',
				dataType: "json",
				success: function(res) {
					//console.log(res);

					ambulance<?php echo e($no); ?> = new google.maps.Marker({
					icon: ambulanceIcon,
					position: new google.maps.LatLng(res.features[0].geometry.coordinates[1], res.features[0].geometry.coordinates[0]),
					map: map,
					title: res.features[0].properties.title
					});
					google.maps.event.addListener(ambulance<?php echo e($no); ?>, 'click', (function (marker, count) {
						return function () {
							infowindow.setContent(format_window_ambulance({nopol:res.features[0].properties.title,rs: '<?php echo e($a->nama_rs); ?>'}));
							infowindow.open(map, ambulance<?php echo e($no); ?>);
						}
					})(marker, count));
				}
			});
		
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			repeat_ambulance+=1;
	    }, 2000); 

	});


	function refresh_bed() {
		/*('#list_bed').load('<?php echo e(base_url('home/bed_data')); ?>','',function(response, status, xhr){
			setTimeout(refresh_bed,50000);
		});*/
		$.get('<?php echo e(base_url('home/bed_data')); ?>', function (data) {
			$('#list_bed1').html(data);
		});
		setInterval(function() {
	        $.get('<?php echo e(base_url('home/bed_data')); ?>', function (data) {
	        	var s = $('#list_status').val();
	        	if (s == "1") {
	        		setTimeout(function() {
	        		$('#list_bed1').hide();
	            	$('#list_bed2').html(data).show();
	            	$('#list_status').val(2);
	            	},5000);
	        	} else {
	        		setTimeout(function() {
	        		$('#list_bed2').hide();
	        		$('#list_bed1').html(data).show();
	            	$('#list_status').val(1);
	            	},5000);
	        	}
	        });
	    }, 5000); 
	}

	function refresh_sms() 
	{
		setInterval(function() {
			$.ajax({
				type: "GET",
				url:'<?php echo e(site_url('home/api_sms')); ?>',
				dataType: "json",
				success: function(res) {
					$.ajax({
	                    url: '<?php echo e(base_url('home/process_sms')); ?>',
	                    type: "POST",
	                    data: res,
	                    cache: false,
	                    dataType: "json",
	                    success: function(ans) {
	                       
	                    },error:function(xhr, ajaxOptions, thrownError){
	                        console.log(JSON.stringify(xhr));
	                    }
	                });
				}
			});
	    }, 1000); 
	}

	function refresh_wa() 
	{
		setInterval(function() {
			$.ajax({
				type: "GET",
				url:'<?php echo e(site_url('home/api_wa')); ?>',
				dataType: "json",
				success: function(res) {
					$.ajax({
	                    url: '<?php echo e(base_url('home/process_wa')); ?>',
	                    type: "POST",
	                    data: res,
	                    cache: false,
	                    dataType: "json",
	                    success: function(ans) {
	                       
	                    },error:function(xhr, ajaxOptions, thrownError){
	                        console.log(JSON.stringify(xhr));
	                    }
	                });
				}
			});
	    }, 1000); 
	}

	function format_window_ambulance(data){
		return "<h5 class=\"mb-0\">"+data.nopol+"</h5>" +
				"<table class=\"table table-bordered info-window\">" +
				"<tbody>" +
				"<tr>" +
				"<td scope=\"col\">RS</td>" +
				"<td scope=\"col\">"+data.rs+"</td>" +
				"</tr></tbody></table>";
	}

	function format_window(data){
		return "<h4 class=\"mb-0\">"+data.nama+"</h4><br>" +
				"<table class=\"table table-bordered info-window\">" +
				"<tbody>" +
				"<tr>" +
				"<td scope=\"col\">Kelas III</td>" +
				"<td scope=\"col\">"+(data.k3?data.k3:'-')+"</td>" +
				"<td scope=\"col\">Ambulan</td>" +
				"<td scope=\"col\">"+(data.ambulance?data.ambulance:'-')+"</td>" +
				"</tr>" +
				"<tr>" +
				"<td>ICU</td>" +
				"<td>"+(data.icu?data.icu:'-')+"</td>" +
				"<td>Ventilator</td>" +
				"<td>"+(data.ventilator?data.ventilator:'-')+"</td></tr></tbody></table>'";
	}
</script>
</body>
</html>
