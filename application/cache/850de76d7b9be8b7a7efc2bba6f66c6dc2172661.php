<?php $__env->startSection('content'); ?>
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Form <?php echo e($page_desc); ?></li>
    </ol>
    <h1 class="page-header f-s-14 f-w-500">Form <?php echo e($page_desc); ?></h1>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-inverse">
				<?php echo form_open('','role="form"'); ?>

				<div class="panel-body">
					<div class="form-group">
						<?php echo form_label('Fasilitas Kesehatan','id_rs'); ?>

						<?php echo form_dropdown('id_rs',$selection_rs,'','class="form-control" id="id_rs" required'); ?>

					</div>
					<div class="form-group">
						<?php echo form_label('Kelas Bed','kelas'); ?>

						<?php echo form_dropdown('kelas',$list_kelas,'','class="form-control" id="kelas" required'); ?>

					</div>
	                <div class="form-group row text-left">
	                	<div class="col-md-12">
							<?php echo form_submit('save','Simpan','class="btn btn-primary btn-sm"'); ?>

							<?php echo form_reset('reset','Reset','class="btn btn-warning btn-sm"'); ?>

							<?php echo anchor(base_url('panel/rumah_sakit/bed'),'Back','class="btn btn-danger btn-sm"'); ?>

						</div>
					</div>
				</div>
				<?php echo form_close(); ?>

			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
	<?php echo $__env->make('partials.toastr_msg', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.panel_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>