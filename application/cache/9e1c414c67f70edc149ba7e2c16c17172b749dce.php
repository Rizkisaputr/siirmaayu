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
						<?php echo form_label('Nama','nama'); ?>

						<?php echo form_input('nama','','class="form-control form-control-sm" id="nama" placeholder="isilah dengan nama lengkap beserta gelar, contoh dr. Alfian Rahmawan, M.Kes"'); ?>

					</div>
					<div class="form-group">
						<?php echo form_label('Profesi','profesi'); ?>

						<?php echo form_input('profesi_name','','class="form-control form-control-sm" id="profesi" placeholder="isilah dengan dokter, bidan, perawat, sopir ambulan, dst"'); ?>

					</div><div class="form-group">
						<?php echo form_label('Nomor SK','data_sk'); ?>

						<?php echo form_input('data_sk','','class="form-control form-control-sm" id="data_sk" placeholder="jika tidak ada isi -"'); ?>

					</div><div class="form-group">
						<?php echo form_label('Alamat','alamat'); ?>

						<?php echo form_input('alamat','','class="form-control form-control-sm" id="alamat" placeholder="contoh: Jl. Karangpawitan - A.Yani no 134, Desa Wararaja, Kec Tarogong"'); ?>

					</div><div class="form-group">
						<?php echo form_label('Telepon','telp'); ?>

						<?php echo form_input('telp','','class="form-control form-control-sm" id="telp" placeholder="Mulailah dengan 62, TANPA SPASI, TANPA STRIP, contoh 628112111828"'); ?>

					</div><div class="form-group">
						<?php echo form_label('Email','email'); ?>

						<?php echo form_input('email','','class="form-control form-control-sm" id="email" placeholder="contoh alfian@gmail.com"'); ?>

					</div><div class="form-group">
						<?php echo form_label('Keterangan','keterangan'); ?>

						<?php echo form_textarea('keterangan','','class="form-control form-control-sm" id="keterangan" style="height: 60px" placeholder="isilah dengan kursus / sertifikasi yg dimiliki : GELS, PPGDON, ATCLS, dst"'); ?>

					</div>
					<div class="form-group">
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
<?php $__env->startSection('head'); ?>
	<link rel="stylesheet" href="<?php echo e(load_asset('plugins/timepicker/bootstrap-timepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
	<?php echo $__env->make('partials.toastr_msg', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.panel_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>