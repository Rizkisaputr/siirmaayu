@extends('layouts.panel_layout')
@section('content')
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Ubah Data WUS / Pasien</li>
    </ol>
    <h1 class="page-header f-s-16 f-w-500"><b>Ubah Data WUS / Pasien</b></h1>
	<div class="row">
		<div class="col-lg-12">
			<div class="panelruj panel-inverse">
				{!! form_open('','role="form"') !!}
				<div class="panel-body">
					<div class="form-group">
						{!! form_label('Nama','nama') !!}
						{!! form_input('nama',$edit_data['nama'],'class="form-control" id="nama" placeholder="Nama Pasien" required') !!}
					</div>
					<div class="form-group">
						{!! form_label('Diagnosa','diagnosa') !!}
						{!! form_input('diagnosa',$edit_data['diagnosa'],'class="form-control" id="diagnosa" placeholder="Diagnosa Pasien" required') !!}
					</div>
					<div class="form-group">
						{!! form_label('Faktor Risiko','risiko') !!}
						{!! form_input('risiko',$edit_data['risiko'],'class="form-control" id="risiko" placeholder="Faktor Risiko" required') !!}
					</div>					
					<div class="form-group">
						{!! form_label('Umur','umur') !!}
						{!! form_input('umur',$edit_data['umur'],'class="form-control" id="umur" placeholder="Umur" required') !!}
					</div>
					<div class="form-group">
						{!! form_label('Penanggung Jawab','pasangan') !!}
						{!! form_input('pasangan',$edit_data['pasangan'],'class="form-control" id="pasangan" placeholder="Penanggung Jawab" required') !!}
					</div>
					<div class="form-group">
						{!! form_label('Faskes Pengampu','rs_owner') !!}
						@if(get_instance()->ion_auth->is_admin())
							{!! form_dropdown('rs_owner[]',$selection_rs,$owners_list,'id="rs_owner" class="form-control select2" multiple="multiple" data-placeholder="Pilih Puskesmas atau Rumah Sakit" style="width: 100%;"') !!}
						@else
							{!! form_dropdown('',$selection_rs,$owners_list,'id="rs_owner" class="form-control select2" multiple="multiple" data-placeholder="Pilih Rumah Sakit" style="width: 100%;" disabled="disabled"') !!}
							<span class="help-block">Hanya Admin yang boleh mengganti pemilik data pasien</span>
						@endif
					</div>
					<div class="form-group">
						{!! form_label('Golongan Darah','goldarah') !!}
						{!! form_input('goldarah',$edit_data['goldarah'],'class="form-control" id="goldarah" placeholder="Golongan Darah" required') !!}
					</div>					
					<div class="form-group">
						{!! form_label('NIK','nik') !!}
						{!! form_input('nik',$edit_data['nik'],'class="form-control" id="nik" placeholder="No Identitas"') !!}
					</div>
					<div class="form-group">
						{!! form_label('Nomor Handphone Pasien','kontak') !!}
						{!! form_input('kontak',$edit_data['kontak'],'class="form-control" id="kontak" placeholder="Mulailah dengan angka 62, contoh: 628112111828"') !!}
					</div>
					<div class="form-group">
						{!! form_label('Tempat/Tanggal Lahir','lahir') !!}
						<div class="row">
							<div class="col-md-4">
								{!! form_input('tempat_lahir','','class="form-control form-control-sm" id="tempat_lahir" placeholder="Tempat Lahir"') !!}
							</div>
							<div class="col-md-8">
	                                
	                                            <!--<label for="tgl_lahir" class="form-control form-control-sm new_group">Tanggal Lahir</label>-->
	                                <div class="datepicker" style="width: 80px">
	                                                <!--{!! form_input('tgl_lahir','','class="form-control form-control-sm new_group" id="tgl_lahir" placeholder="Tanggal Lahir Pasien"') !!}
	                                                <div class="col-md-8">
													{!! form_input('tgl_lahir','','class="form-control form-control-sm new_group" id="tgl_lahir" placeholder="Tanggal Lahir"') !!}
													</div>-->
	                            <input type="date" class="datepicker" name="tgl_lahir" id="date">
	                            </div>
	                         </div>
						</div>
					</div>
					<div class="form-group">
						{!! form_label('Jenis Kelamin','jenis_kelamin') !!}
						{!! form_dropdown('jenis_kelamin',array('Perempuan'=>'Perempuan','Laki-laki'=>'Laki-laki'),$edit_data['jenis_kelamin'],'class="form-control new_group" id="jenis_kelamin" placeholder="Jenis Kelamin"') !!}
					</div>
					<div class="form-group">
						{!! form_label('Alamat','alamat') !!}
						{!! form_textarea('alamat',$edit_data['alamat'],'class="form-control" rows="3" placeholder="Alamat Pasien..."style="height: 50px;"') !!}
					</div>
					<div class="form-group">
						{!! form_label('Lokasi Pasien','position') !!}
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
				        	{!! anchor(base_url('panel/rujukan/pasien'),'<i class="fas fa-arrow-alt-circle-left"></i> Kembali','class="btn btn-sm btn-warning"') !!}
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
	<script src="{{load_asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
	<script src="{{load_asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
	<script src="{{load_asset('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
	<script type="text/javascript">
		$(function(){
			$('#rs_owner').select2();
			$('#tgl_lahir').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		});
	</script>
	<script src="{{load_asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
	<script language="javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmiOV5wIJ8iN7qjIcs3R9wtW1gv4mkMPA"></script>
	<script type="text/javascript">
		window.onload = function () {
			//-6.595038,‎106.816635
			var myLatlng = new google.maps.LatLng(-7.2161829,107.909729);			
			//var myLatlng = new google.maps.LatLng(-6.3131123,107.3467937); 
			var mapOptions = {
				center: myLatlng,
				zoom: 13
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
			$('#Alamat').select2();
		});
	</script>
@endsection


