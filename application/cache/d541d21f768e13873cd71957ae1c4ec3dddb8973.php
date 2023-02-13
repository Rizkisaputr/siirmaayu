<?php $__env->startSection('content'); ?>
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Form <?php echo e($page_desc); ?></li>
    </ol>
	<h1 class="page-header f-s-14 f-w-500">Form <?php echo e($page_desc); ?></h1>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-inverse">
				<?php echo form_open('','role="form"'); ?>

				<div class="panel-body">
					<div class="form-group">
						 <?php echo form_dropdown('id_dokter',$selection_dokter,'','class="form-control default-select2" id="id_dokter" required style="width: 100%"'); ?>

					</div>
					<div class="form-group">
						<?php echo form_label('Hari','hari'); ?>

						<?php echo form_dropdown('hari',$selection_hari,intval(date('N'))-1,'class="form-control form-control-sm" id="hari"'); ?>

					</div>
					<div class="row">
						<div class="col-xs-4">
							<div class="bootstrap-timepicker">
								<div class="form-group">
									<?php echo form_label('Jam Mulai','jam_mulai'); ?>

									<?php echo form_input('jam_mulai','','class="form-control form-control-sm timepicker" id="jam_mulai"'); ?>

								</div>
							</div>
						</div>
						<div class="col-xs-4">
							<div class="bootstrap-timepicker">
								<div class="form-group">
									<?php echo form_label('Jam Selesai','jam_selesai'); ?>

									<?php echo form_input('jam_selesai','','class="form-control form-control-sm timepicker" id="jam_selesai"'); ?>

								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_submit('save','Simpan','class="btn btn-primary btn-sm"'); ?>

						<?php echo form_reset('reset','Reset','class="btn btn-warning btn-sm"'); ?>

						<?php echo anchor(base_url('panel/rumah_sakit/jadwal_dokter'),'Back','class="btn btn-danger btn-sm"'); ?>

					</div>
				</div>
				
				<?php echo form_close(); ?>

			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('head'); ?>
	<link rel="stylesheet" href="<?php echo e(load_asset('plugins/timepicker/bootstrap-timepicker.min.css')); ?>">
	
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
	<?php echo $__env->make('partials.toastr_msg', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<!-- date-range-picker -->
	<script src="<?php echo e(load_asset('bower_components/moment/min/moment.min.js')); ?>"></script>
	<script src="<?php echo e(load_asset('plugins/timepicker/bootstrap-timepicker.min.js')); ?>"></script>
	<script type="text/javascript">
		$(function(){
			my_time_pick();
		});
		function my_time_pick() {
			$('.timepicker').timepicker({
				showInputs: false,
				minuteStep: 5,
				showMeridian: false
			})
			var el_mulai=$("#jam_mulai"),el_selesai=$("#jam_selesai");
			el_selesai.on('change',check_jam_input);
			el_mulai.on('change',check_jam_input);
			function check_jam_input() {
				if(time_compare_goe(el_mulai.val(),el_selesai.val())){
					toastr['warning']('Jam selesai lebih kecil dari jam mulai');
					var a=el_selesai.val(),b=el_mulai.val();
					console.log([a.slice(0,a.search(':')),a.slice(a.search(':')+1)],'>=',[b.slice(0,b.search(':')),b.slice(b.search(':')+1)]);
				}
			}
		}
		function time_compare_goe(a,b) {
			var dia=a.search(':'),dib=b.search(':');
			if(dia===-1||dib===-1){
				toastr['error']('Anda menginputkan jam dengan salah');
				return;
			}
			var pa=[Number(a.slice(0,a.search(':'))),Number(a.slice(a.search(':')+1))],pb=[Number(b.slice(0,b.search(':'))),Number(b.slice(b.search(':')+1))];

			return pa[0]>=pb[0]&&pa[1]>=pb[1];
		}
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.panel_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>