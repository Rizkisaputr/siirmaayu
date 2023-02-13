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

	<title>{{$application_name}} | {{$title}}</title>

	<style>
	</style>
</head>
<body>
<!-- old navbar-brand -->
<nav class="navbar navbar-light bg-white justify-content-between">
	<div class="container">
		<a class="navbar-brand" href="{{base_url('auth/login')}}">
			<img class="mr-2" src="{{load_asset('front/images/logo_kemenkes.png')}}" alt="">
			<img class="mr-2" src="https://upload.wikimedia.org/wikipedia/commons/d/de/Lambang_Kota_Cilegon.png" alt="">
			<img class="mr-2" src="{{load_asset('front/images/psc.png')}}" alt="">
		</a>
		<!-- <form class="form-inline" method="GET" action="{{base_url('auth/login')}}">
			<button class="btn btn-outline-primary my-1 my-sm-0 btn-sm" type="submit"><span class="lnr lnr-lock"></span> Masuk Aplikasi</button>
		</form> -->
		<a class="navbar-brand" href="#">
			<img class="" src="{{load_asset('front/images/support.jpg')}}" alt="">
		</a>
	</div>
</nav>
<!-- end old navbar -->


<header class="text-center" style="background:url('{{load_asset('front/images/bg.jpg')}}')">
	<!-- <img class="text-center logo-kab" src="https://upload.wikimedia.org/wikipedia/commons/d/de/Lambang_Kota_Cilegon.png" alt=""> -->
	<h2 class="font-weight-bold" style="font-size: 1.5rem!important;">SERASI</h2>
	<h2 class="font-weight-bold" style="font-size: 1.2rem!important;">{{$application_long_name}}</h2>
	<h6>{{$application_name}}</h6>
</header>

<section class="container p-2 card mb-2 tables">
	<div class="row">
		<div class="col-sm-12">
			<h3 class="font-weight-bold p-1" style="font-size: 1rem!important;">Dashboard Ketersediaan Tempat Tidur</h3>
			<div class="live">
				<div class="live-animate">
					<div style="width:12px; height:12px"></div>
				</div>
				<h5 style="font-size: 14px;">Live Update</h5>
			</div>
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
						<th colspan="3">VVIP</th>-->
						<th rowspan="3">IGD</th>
						<th rowspan="3">PONEK</th>
						<th rowspan="3">VK</th>
						<th rowspan="3">NIFAS</th>
						<th rowspan="3">PERI</th>
						<th rowspan="3">COVID<br>HIJAU</th>
						<th rowspan="3">COVID<br>KUNING</th>
						<th rowspan="3">COVID<br>MERAH</th>
						<th rowspan="3">ISOLASI<br>IGD</th>
						<th rowspan="3">ISOLASI<br>ICU</th>
						
						<th rowspan="3">ICU</th>
						<th rowspan="3">HCU</th>
						<th rowspan="3">NICU</th>				
						<th rowspan="3">PICU</th>
						<th rowspan="3">RUJUKAN<br>BLM DIRESPON</th>
						<!-- <th rowspan="3">VENTI<br>LATOR</th>
						<th rowspan="3">Ambu<br>lan</th>-->
						<th colspan="7">Dokter Spesialis On-Site</th>
						<th rowspan="3">Update <br> Bed <br> Terakhir</th>
					</tr>
					<tr>
						<th rowspan="2">KPS</th>
						<th colspan="2">Kosong</th>
						<th rowspan="2">KPS</th>
						<th colspan="2">Kosong</th>
						<th rowspan="2">KPS</th>
						<th colspan="2">Kosong</th>
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
		          <i style="color: red; font-size: 11px!important;">KPS (Kapasitas) /</i>
		          <i style="color: red; font-size: 11px!important;">L (Laki-laki) /</i>
		          <i style="color: red; font-size: 11px!important;">P (Perempuan)</i>
		        </div>
			</div>
		</div>
	</div>
	<input type="hidden" id="list_status" value="1">
</section>



<section class="container p-0 card mb-2 maps">
	<h3 class="p-2 mb-0 gr-primary text-white" style="font-size: 1rem!important;">Peta GIS Fasilitas Kesehatan</h3>
	<div id="map"></div>
	<script
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWNMcrmczTJO_KZDGIun4O7v6kU4QGrks">
	</script>
</section>

<footer class="m-2 text-center">
	<p style="font-size: 14px;">Copyright © {{$application_copyright}}</p>
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
				<p class="text-right mb-0" style="font-size: 14px;">© 2018 Dinas Kesehatan Kota Cilegon</p>
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
		refresh_sms();
		$('#exampleModal').on('show.bs.modal',function(event){
			var idrs=$(event.relatedTarget).attr('data-idrs');
			$('#detail-rs').html('Loading');
			$('#detail-rs').load("{{base_url('home/rs_detil')}}/"+idrs,'',function(res,stat,xhr){
				console.log(res,stat,xhr);
			});
		});
		//maps
		var center = {
			lat: -6.009109,
			lng: 106.058501
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
		$.get('{{base_url('home/rs_map')}}',function(res){
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
		/*('#list_bed').load('{{base_url('home/bed_data')}}','',function(response, status, xhr){
			setTimeout(refresh_bed,50000);
		});*/
		$.get('{{base_url('home/bed_data')}}', function (data) {
			$('#list_bed1').html(data);
		});
		setInterval(function() {
	        $.get('{{base_url('home/bed_data')}}', function (data) {
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
	    }, 10000); 
	}

	function refresh_sms() 
	{
		setInterval(function() {
			$.ajax({
				type: "GET",
				url:'{{site_url('home/api_sms')}}',
				dataType: "json",
				success: function(res) {
					$.ajax({
	                    url: '{{ base_url('home/process_sms') }}',
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
	    }, 10000); 
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
