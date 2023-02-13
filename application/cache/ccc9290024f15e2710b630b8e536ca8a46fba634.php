<?php $__env->startSection('content'); ?>
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Form <?php echo e($page_desc); ?></li>
    </ol>
    <h1 class="page-header f-s-14 f-w-500">Form <?php echo e($page_desc); ?></h1>
	<div class="row">
		<div class="col-md-12">
			<div class="panelruj panel-inverse">
				<?php echo form_open('','role="form"'); ?>

				<div class="panel-body">
					<div class="form-group">
						<?php echo form_label('Nama','nama'); ?>

						<?php echo form_input('nama',$edit_data['nama'],'class="form-control form-control-sm" id="nama" placeholder="Nama Fasilitas Kesehatan" required'); ?>

					</div>
					<div class="form-group">
						<?php echo form_label('Kode','kode_rs'); ?>

						<?php echo form_input('kode_rs',$edit_data['kode_rs'],'class="form-control form-control-sm" id="kode_rs" placeholder="Kode Fasilitas Kesehatan"'); ?>

					</div>
					<div class="form-group">
						<?php echo form_label('Telepon','telepon'); ?>

						<?php echo form_input('telepon',$edit_data['telepon'],'class="form-control form-control-sm" id="telepon" placeholder="Nomor Telepon Fasilitas Kesehatan" required'); ?>

					</div>
					<div class="form-group">
						<?php echo form_label('Jenis','jenis'); ?>

						<?php echo form_dropdown('jenis',$jenis_rs,$edit_data['jenis'],'class="form-control form-control-sm" id="jenis" placeholder="Jenis Fasilitas Kesehatan" required'); ?>

					</div>
					<div class="form-group">
						<?php echo form_label('Layanan','layanan'); ?>

						<?php echo form_dropdown('layanan[]',$selection_fasilitas,$edit_data['layanan'],'id="layanan" class="form-control form-control-sm select2" multiple="multiple" data-placeholder="Pilih Layanan yang tersedia" style="width: 100%;"'); ?>

					</div>
					<div class="form-group">
						<?php echo form_label('Alamat','alamat'); ?>

						<?php echo form_textarea('alamat',$edit_data['alamat'],'class="form-control form-control-sm" rows="3" placeholder="Alamat Fasilitas Kesehatan..."style="height: 65px;"'); ?>

					</div>
					<div class="form-group">
						<?php echo form_label('Posisi','position'); ?>

						<div class="row">
							<div class="col-md-8">
								<div id="map" style="width: 100%;height: 200px;"></div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<?php echo form_label('Latitude','latitude'); ?>

									<?php echo form_input('pos_lat',$edit_data['pos_lat'],'class="form-control form-control-sm" placeholder="Latitude" id="latitude"'); ?>

								</div>
								<div class="form-group">
									<?php echo form_label('Longitude','longitude'); ?>

									<?php echo form_input('pos_lon',$edit_data['pos_lon'],'class="form-control form-control-sm" placeholder="Longitude" id="longitude"'); ?>

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
				        	<?php echo anchor(base_url('panel/rumah_sakit/rs'),'<i class="fas fa-arrow-alt-circle-left"></i> Back','class="btn btn-sm btn-warning"'); ?>

				        </div>
				    </div>
				    <div class="pull-right">
				        <div class="dropdown">
				            <!-- <a href="#" class="btn btn-sm btn-success">
				              Tambah Data
				              <i class="fas fa-arrow-alt-circle-right"></i>
				            </a> -->
				            <?php echo form_submit('save','Simpan','class="btn btn-success btn-sm"'); ?>

				        </div>
				    </div>
				    <div class="clearfix"></div>
				</footer>
				<?php echo form_close(); ?>

			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('head'); ?>
	<link rel="stylesheet" href="<?php echo e(load_asset('bower_components/select2/dist/css/select2.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
	<?php echo $__env->make('partials.toastr_msg', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<script src="<?php echo e(load_asset('bower_components/select2/dist/js/select2.full.min.js')); ?>"></script>
	<script language="javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmiOV5wIJ8iN7qjIcs3R9wtW1gv4mkMPA"></script>
	<script type="text/javascript">
		window.onload = function () {
			//-6.595038,‎106.816635
			var myLatlng = new google.maps.LatLng(<?php echo $edit_data['pos_lat']?$edit_data['pos_lat']:'-6.595038'; ?>,<?php echo $edit_data['pos_lon']?$edit_data['pos_lon']:'106.816635'; ?>);
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.panel_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>