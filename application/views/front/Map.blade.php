<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/png" href="{{load_asset('front/images/favicon.png')}}" />

	<!-- Fonts -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

	<!-- Font Icon -->
	<link rel="stylesheet" href="{{load_asset('new-assets/plugins/ionicons/css/ionicons.min.css')}}">

	<!-- Style RDS -->
	<link rel="stylesheet" href="{{load_asset('front/css/style.minify.css')}}" async="async">
	<link rel="stylesheet" href="{{load_asset('front/css/custom.css')}}">
	<link href="<?php echo base_url()?>assets/bower_components/bootstrap-datepicker/bootstrap-datepicker.js" rel="stylesheet" media="screen">

	<title>{{$application_name}} {{$version}} | {{$title}}</title>

	<style>
	</style>
</head>
<body>
<!-- old navbar-brand -->
<nav class="navbar navbar-light bg-gradient-aqua justify-content-between">
	<div class="container">
		<a class="navbar-brand">
			<img class="mr-3" src="./assets/front/images/logo_psc.png" alt="">
			<img class="mr-3" src="./assets/front/images/logo_kabupaten.png" alt="">
			<img class="mr-3" id="onlinestatus" src="./assets/sijariemas/img/sijariemas.png" alt="">
		</a>
			<h4 align="center"><b><font size='4' color='#03b290'>Peta GIS Fasilitas Kesehatan <br> {{$application_copyright}} </font></b></h4>
							<div class="live"> <div class="live-animate"><div style="width:12px; height:12px"></div></div>
							<h5 style="font-size: 15px;">Live Update</h5>
							</div>
		<form class="form-inline" method="GET" action="{{base_url('auth/login')}}">
			<button class="btn btn-outline-primary my-1 my-sm-0 btn-sm" type="submit"><span class="lnr lnr-lock"></span>Masuk Aplikasi</button>
		</form>
 
	</div>
</nav>
<!-- end old navbar -->


<section class="container p-0 card mb-2 maps">
	<div id="map"></div>
	<script
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWNMcrmczTJO_KZDGIun4O7v6kU4QGrks">
	</script>
</section>

<footer class="m-2 text-center">
	<p style="font-size: 14px;">Copyright © 2013-2020 {{$application_copyright}}</p>
</footer>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel" style="font-size: 14px;">Detail Layanan Kesehatan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="detail-rs" class="modal-body">
			</div>
			<div class="modal-footer">
				<p class="text-right mb-0" style="font-size: 14px;">© 2013-2020 {{$application_copyright}}</p>
			</div>
		</div>
	</div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{load_asset('front/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{load_asset('front/js/bootstrap.bundle.min.js')}}"></script>
<script type="text/javascript">
	$(function(){
		refresh_bed();
		//refresh_sms();
		$('#exampleModal').on('show.bs.modal',function(event){
			var idrs=$(event.relatedTarget).attr('data-idrs');
			$('#detail-rs').html('Loading');
			$('#detail-rs').load("{{base_url('map/rs_detil')}}/"+idrs,'',function(res,stat,xhr){
				console.log(res,stat,xhr);
			});
		});
		refresh_wa();
		$('#exampleModal').on('show.bs.modal',function(event){
			var idrs=$(event.relatedTarget).attr('data-idrs');
			$('#detail-rs').html('Loading');
			$('#detail-rs').load("{{base_url('map/rs_detil')}}/"+idrs,'',function(res,stat,xhr){
				console.log(res,stat,xhr);
			});
		});
		//maps
		var center = {
			lat: -6.4399977,
			lng: 108.2214933
		};
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 11,
			center: center,
			mapTypeId: 'hybrid',
			styles: [{
				"stylers":[{"hue":"#ffaa00"},{"saturation":65}]},{"featureType":"all","elementType": "all","stylers":[{"visibility": "on"}]},{"featureType":"road","elementType": "geometry.stroke","stylers":[{"gamma": 0.06},{"lightness": 80}]},{"featureType":"poi","elementType":"geometry","stylers":[{"visibility":"on"}]
			}]
		});
		var infowindow = new google.maps.InfoWindow({});
		var markerIcon = {
			url: 'https://image.flaticon.com/icons/svg/119/119065.svg',
			scaledSize: new google.maps.Size(25, 25),
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
		$.get('{{base_url('map/rs_map')}}',function(res){
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
			@foreach($ambulance->result() as $no => $a)

			if (parseInt(repeat_ambulance) > 0) ambulance{{$no}}.setMap(null);
			
			$.ajax({
				type: "GET",
				url:'{{ $a->api }}',
				dataType: "json",
				success: function(res) {
					//console.log(res);

					ambulance{{$no}} = new google.maps.Marker({
					icon: ambulanceIcon,
					position: new google.maps.LatLng(res.features[0].geometry.coordinates[1], res.features[0].geometry.coordinates[0]),
					map: map,
					title: res.features[0].properties.title
					});
					google.maps.event.addListener(ambulance{{$no}}, 'click', (function (marker, count) {
						return function () {
							infowindow.setContent(format_window_ambulance({nopol:res.features[0].properties.title,rs: '{{$a->nama_rs}}'}));
							infowindow.open(map, ambulance{{$no}});
						}
					})(marker, count));
				}
			});
		
			@endforeach
			repeat_ambulance+=1;
	    }, 2000); 

	});


	function refresh_bed() {
		/*('#list_bed').load('{{base_url('map/bed_data')}}','',function(response, status, xhr){
			setTimeout(refresh_bed,50000);
		});*/
		$.get('{{base_url('map/bed_data')}}', function (data) {
			$('#list_bed1').html(data);
		});
		setInterval(function() {
	        $.get('{{base_url('map/bed_data')}}', function (data) {
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
				url:'{{site_url('map/api_sms')}}',
				dataType: "json",
				success: function(res) {
					$.ajax({
	                    url: '{{ base_url('map/process_sms') }}',
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
				url:'{{site_url('map/api_wa')}}',
				dataType: "json",
				success: function(res) {
					$.ajax({
	                    url: '{{ base_url('map/process_wa') }}',
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
				"<td scope=\"col\">ICU</td>" +
				"<td scope=\"col\">"+(data.icu?data.icu:'-')+"</td>" +
				"<td scope=\"col\">NICU</td>" +
				"<td scope=\"col\">"+(data.nicu?data.nicu:'-')+"</td>" +
				"<td scope=\"col\">Isolasi IGD</td>" +
				"<td scope=\"col\">"+(data.isolasi_igd?data.isolasi_igd:'-')+"</td>" +
				"<td scope=\"col\">Isolasi ICU</td>" +
				"<td scope=\"col\">"+(data.isolasi_icu?data.isolasi_icu:'-')+"</td>" +
				"<td scope=\"col\">Isolasi PERINA</td>" +
				"<td scope=\"col\">"+(data.isolasi_perina?data.isolasi_perina:'-')+"</td>" +
				"</tr>" +
				"<tr>" +
				"<td>Covid Hijau</td>" +
				"<td>"+(data.covid_hijau?data.covid_hijau:'-')+"</td>" +
				"<td>Covid Kuning</td>" +
				"<td>"+(data.covid_kuning?data.covid_kuning:'-')+"</td>" +
				"<td>Covid Merah</td>" +
				"<td>"+(data.covid_merah?data.covid_merah:'-')+"</td>" +
				"<td>VK</td>" +
				"<td>"+(data.vk?data.vk:'-')+"</td>" +
				"<td>Ventilator</td>" +
				"<td>"+(data.ventilator?data.ventilator:'-')+"</td></tr></tbody></table><br>*Data Indikatif, untuk memastikan telpon Call Center 119'";
	}
</script>
</body>
</html>
