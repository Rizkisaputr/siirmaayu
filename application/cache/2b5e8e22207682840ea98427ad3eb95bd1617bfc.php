<?php $__env->startSection('content'); ?>
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Tambah Data Pasien</li>
    </ol>
    <h1 class="page-header f-s-14 f-w-500">Tambah Data Pasien</h1>
	<div class="row">
		<div class="col-lg-12">
			<div class="panelruj panel-inverse">
				<?php echo form_open('','role="form"'); ?>

				<div class="panel-body">
					<div class="form-group">
						<?php echo form_label('Nama WUS / Pasien','nama'); ?>

						<?php echo form_input('nama','','class="form-control" id="nama" placeholder="Nama WUS / Pasien" required'); ?>

					</div>
					<div class="form-group">
						<?php echo form_label('Nama Pasangan / Penanggung Jwb','pasangan'); ?>

						<?php echo form_input('pasangan','','class="form-control" id="pasangan" placeholder="Nama Suami / Penanggung Jawab" required'); ?>

					</div>					
					<div class="form-group">
						<?php echo form_label('Diagnosa','diagnosa'); ?>

						<?php echo form_input('diagnosa','','class="form-control" id="diagnosa" placeholder="Isilah dengan diagnosa dokter" required'); ?>

					</div>
					<div class="form-group">
						<?php echo form_label('Faktor Risiko','risiko'); ?>

						<?php echo form_input('risiko','','class="form-control" id="risiko" placeholder="Isilah dengan Semua Faktor Risiko terdeteksi" required'); ?>

					</div>
					<div class="form-group">
						<?php echo form_label('Faskes Pengampu','rs_owner'); ?>

						<?php echo form_dropdown('rs_owner[]',$selection_rs,'','id="rs_owner" class="form-control form-control-sm select2" multiple="multiple" data-placeholder="Pilih Puskesmas atau Rumah Sakit" style="width: 100%;"'); ?>

					</div>					
					<div class="form-group">
						<?php echo form_label('NIK','nik'); ?>

						<?php echo form_input('nik','','class="form-control form-control-sm" id="nik" placeholder="No Identitas"'); ?>

					</div>
					<div class="form-group">
						<?php echo form_label('Nomor Handphone Pasien','kontak'); ?>

						<?php echo form_input('kontak','','class="form-control form-control-sm" id="kontak" placeholder="Nomor Telepon"'); ?>

					</div>
					<div class="form-group">
						<?php echo form_label('Tempat/Tanggal Lahir','lahir'); ?>

						<div class="row">
							<div class="col-md-4">
								<?php echo form_input('tempat_lahir','','class="form-control form-control-sm" id="tempat_lahir" placeholder="Tempat Lahir"'); ?>

							</div>
							<div class="col-md-8">
	                                
	                                            <!--<label for="tgl_lahir" class="form-control form-control-sm new_group">Tanggal Lahir</label>-->
	                                <div class="datepicker" style="width: 80px">
	                                                <!--<?php echo form_input('tgl_lahir','','class="form-control form-control-sm new_group" id="tgl_lahir" placeholder="Tanggal Lahir Pasien"'); ?>

	                                                <div class="col-md-8">
													<?php echo form_input('tgl_lahir','','class="form-control form-control-sm new_group" id="tgl_lahir" placeholder="Tanggal Lahir"'); ?>

													</div>-->
	                            <input type="date" class="datepicker" name="tgl_lahir" id="date">
	                            </div>
	                         </div>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Jenis Kelamin','jenis_kelamin'); ?>

						<?php echo form_dropdown('jenis_kelamin',array('Perempuan'=>'Perempuan','Laki-laki'=>'Laki-laki'),'','class="form-control form-control-sm new_group" id="jenis_kelamin" placeholder="Jenis Kelamin"'); ?>

					</div>
					<div class="form-group">
						<?php echo form_label('Alamat','alamat'); ?>

						<?php echo form_textarea('alamat','','class="form-control form-control-sm" rows="2" placeholder="Alamat Pasien..."style="height: 50px;"'); ?>

					</div>
					<div class="form-group">
						<?php echo form_label('Lokasi Pasien','position'); ?>

						<div class="row">
							<div class="col-md-8">
								<div id="map" style="width: 100%;height: 200px;"></div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<?php echo form_label('Latitude','latitude'); ?>

									<?php echo form_input('pos_lat','','class="form-control form-control-sm" placeholder="Latitude" id="latitude"'); ?>

								</div>
								<div class="form-group">
									<?php echo form_label('Longitude','longitude'); ?>

									<?php echo form_input('pos_lon','','class="form-control form-control-sm" placeholder="Longitude" id="longitude"'); ?>

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
				        	<?php echo anchor(base_url('panel/rujukan/pasien'),'<i class="fas fa-arrow-alt-circle-left"></i> Back','class="btn btn-sm btn-warning"'); ?>

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
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('head'); ?>
	<link rel="stylesheet" href="<?php echo e(load_asset('bower_components/select2/dist/css/select2.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
	<?php echo $__env->make('partials.toastr_msg', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<script src="<?php echo e(load_asset('bower_components/select2/dist/js/select2.full.min.js')); ?>"></script>
	<script src="<?php echo e(load_asset('plugins/input-mask/jquery.inputmask.js')); ?>"></script>
	<script src="<?php echo e(load_asset('plugins/input-mask/jquery.inputmask.date.extensions.js')); ?>"></script>
	<script src="<?php echo e(load_asset('plugins/input-mask/jquery.inputmask.extensions.js')); ?>"></script>
	<script type="text/javascript">
		$(function(){
			$('#rs_owner').select2();
			$('#tgl_lahir').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		});
	</script>
	<script src="<?php echo e(load_asset('bower_components/select2/dist/js/select2.full.min.js')); ?>"></script>
	<script language="javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmiOV5wIJ8iN7qjIcs3R9wtW1gv4mkMPA"></script>
	<script type="text/javascript">
		window.onload = function () {
			//-6.595038,‎106.816635
			var myLatlng = new google.maps.LatLng(-7.2161829,107.909729);
			//var myLatlng = new google.maps.LatLng(-6.3131123,107.3467937); 
			var mapOptions = {
				center: myLatlng,
				zoom: 12
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.panel_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>