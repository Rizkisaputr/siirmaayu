<?php $__env->startSection('content'); ?>
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Form <?php echo e($page_desc); ?></li>
    </ol>
	<h1 class="page-header f-s-14 f-w-500">Form <?php echo e($page_desc); ?></h1>
	<div class="row">
		<div class="col-md-12">
			<div class="panel -panel-inverse">
				<?php echo form_open('','role="form"'); ?>

				<div class="panel-body">
					<div class="form-group">
						<?php echo form_label('Nama Fasilitas Kesehatan','id_rs'); ?>

						<?php echo form_dropdown('id_rs',$selection_rs,'','class="form-control form-control-sm" id="id_rs" required'); ?>

					</div>
					<div class="form-group">
						<?php echo form_label('Golongan Darah','gol_darah'); ?>

						<?php echo form_dropdown('gol_darah',$selection_gol_darah,null,'class="form-control form-control-sm" id="gol_darah"'); ?>

					</div>
					<div class="form-group">
						<?php echo form_label('Stok','stok'); ?>

						<?php echo form_input('stok','','class="form-control form-control-sm" id="stok"'); ?>

					</div>
					<div class="form-group">
						<?php echo form_label('Keterangan','keterangan'); ?>

						<?php echo form_textarea('keterangan','','class="form-control form-control-sm" id="keterangan" style="height: 60px"'); ?>

					</div><div class="form-group">
						<?php echo form_submit('save','Simpan','class="btn btn-primary btn-sm"'); ?>

						<?php echo form_reset('reset','Reset','class="btn btn-warning btn-sm"'); ?>

						<?php echo anchor(base_url('panel/rumah_sakit/ambulance'),'Back','class="btn btn-danger btn-sm"'); ?>

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