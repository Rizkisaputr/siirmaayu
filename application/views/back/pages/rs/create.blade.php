@extends('layouts.panel_layout')

@section('content')
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Form {{$page_desc}}</li>
    </ol>
    <h1 class="page-header f-s-14 f-w-500">Form {{$page_desc}}</h1>
	<div class="row">
		<div class="col-lg-12">
			<div class="panelruj panel-inverse">
				{!! form_open('','role="form"') !!}
				<div class="panel-body">
					<div class="form-group">
						{!! form_label('Nama','nama') !!}
						{!! form_input('nama','','class="form-control form-control-sm" id="nama" placeholder="Nama Fasilitas Kesehatan" required') !!}
					</div>
					<div class="form-group">
						{!! form_label('Kode','kode_rs') !!}
						{!! form_input('kode_rs','','class="form-control form-control-sm" id="kode_rs" placeholder="Kode Fasilitas Kesehatan"') !!}
					</div>
					<div class="form-group">
						{!! form_label('Telepon','telepon') !!}
						{!! form_input('telepon','','class="form-control form-control-sm" id="telepon" placeholder="Nomor Telepon Fasilitas Kesehatan" required') !!}
					</div>
					<div class="form-group">
						{!! form_label('Jenis','jenis') !!}
						{!! form_dropdown('jenis',$jenis_rs,'Rumah Sakit','class="form-control form-control-sm" id="jenis" placeholder="Jenis Fasilitas Kesehatan" required') !!}
					</div>
					<div class="form-group">
						{!! form_label('Layanan','layanan') !!}
						{!! form_dropdown('layanan[]',$selection_fasilitas,'','id="layanan" class="form-control form-control-sm select2" multiple="multiple" data-placeholder="Pilih Layanan yang tersedia" style="width: 100%;"') !!}
					</div>
					<div class="form-group">
						{!! form_label('Alamat','alamat') !!}
						{!! form_textarea('alamat','','class="form-control form-control-sm" rows="3" placeholder="Alamat Fasilitas Kesehatan..." style="height: 65px;"') !!}
					</div>
					<div class="form-group">
						{!! form_label('Posisi','position') !!}
						<div class="row">
							<div class="col-md-8">
								<div id="map" style="width: 100%;height: 200px;"></div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									{!! form_label('Latitude','latitude') !!}
									{!! form_input('pos_lat','','class="form-control form-control-sm" placeholder="Latitude" id="latitude"') !!}
								</div>
								<div class="form-group">
									{!! form_label('Longitude','longitude') !!}
									{!! form_input('pos_lon','','class="form-control form-control-sm" placeholder="Longitude" id="longitude"') !!}
								</div>
								<div class="form-group">
									<a href="javascript:void(0)" class="btn btn-default" id="btn-refresh-lokasi">Refresh Lokasi</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<footer class="footer-content bg-silver">
				    <div class="pull-left">
				        <div class="dropdown">
				        	{!! anchor(base_url('panel/rumah_sakit/rs'),'<i class="fas fa-arrow-alt-circle-left"></i> Back','class="btn btn-sm btn-warning"') !!}
				        </div>
				    </div>
				    <div class="pull-right">
				        <div class="dropdown">
				            <!-- <a href="#" class="btn btn-sm btn-success">
				              Tambah Data
				              <i class="fas fa-arrow-alt-circle-right"></i>
				            </a> -->
				            {!! form_submit('save','Simpan','class="btn btn-success btn-sm"') !!}
				        </div>
				    </div>
				    <div class="clearfix"></div>
				</footer>
				{!! form_close() !!}
			</div>
		</div>
	</div>
</div>
@endsection

@section('head')
	<link rel="stylesheet" href="{{load_asset('bower_components/select2/dist/css/select2.min.css')}}">
@endsection

@section('script')
	@include('partials.toastr_msg')
	<script src="{{load_asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
	<script language="javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmiOV5wIJ8iN7qjIcs3R9wtW1gv4mkMPA"></script>
	<script type="text/javascript">
		window.onload = function () {
			//-6.595038,???106.816635
			var myLatlng = new google.maps.LatLng(-6.595038,106.816635);
			var mapOptions = {
				center: myLatlng,
				zoom: 15
			};
			//var infoWindow = new google.maps.InfoWindow();
			//var latlngbounds = new google.maps.LatLngBounds();
			var map = new google.maps.Map(document.getElementById("map"), mapOptions);

			var marker = new google.maps.Marker({
				position: myLatlng,
				draggable:true,
				title:"Lokasi RS"
			});
			google.maps.event.addListener(map, 'click', function (e) {
				var pos = new google.maps.LatLng(e.latLng.lat().toFixed(5),e.latLng.lng().toFixed(5));
				marker.setPosition(pos);
				document.getElementById("latitude").value=e.latLng.lat().toFixed(5);
				document.getElementById("longitude").value=e.latLng.lng().toFixed(5);
			});

			// To add the marker to the map, call setMap();
			google.maps.event.addListener(marker, 'dragend', function(e){
				document.getElementById("latitude").value=e.latLng.lat().toFixed(5);
				document.getElementById("longitude").value=e.latLng.lng().toFixed(5);
			});

			marker.setMap(map);

			//btn refresh
			document.getElementById("btn-refresh-lokasi").onclick=function(){
				var pos = new google.maps.LatLng(
						document.getElementById("latitude").value,
						document.getElementById("longitude").value
				);
				marker.setPosition(pos);
				map.setCenter(pos);
			}
		}
		$(function(){
			$('#layanan').select2();
		});
	</script>
@endsection
