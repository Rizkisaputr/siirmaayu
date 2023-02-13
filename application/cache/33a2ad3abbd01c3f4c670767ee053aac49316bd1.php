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
						<?php echo form_label('Nama Fasilitas Kesehatan','id_rs'); ?>

						<?php echo form_dropdown('id_rs',$selection_rs,$edit_data['id_rs'],'class="form-control form-control-sm" id="id_rs" required'); ?>

					</div>
					<div class="form-group">
						<?php echo form_label('Nama Bed','nama'); ?>

						<?php echo form_input('nama',$edit_data['nama'],'class="form-control form-control-sm" id="nama" placeholder="Nama Bed Rumah Sakit" required'); ?>

					</div>
					<div class="form-group">
						<?php echo form_label('Kelas Bed','kelas'); ?>

						
						<select name="kelas" class="form-control" id="kelas" placeholder="Kelas Bed" required>
							<?php $__currentLoopData = $list_kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kelas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($kelas->id_kelas_bed); ?>" <?php echo e($edit_data['kelas']===$kelas->id_kelas_bed?'selected':''); ?> data-unigender="<?php echo e($kelas->unigender); ?>"><?php echo e($kelas->nama); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</div>
					<div class="form-group">
						<?php echo form_label('Kapasitas','kapasitas'); ?>

						<div class="row">
							<div class="col-md-4">
								<?php echo form_input('kapasitas_l',$edit_data['kapasitas_l'],'class="form-control form-control-sm laki-laki" id="kapasitas_l" placeholder="Kapasitas Bed Laki-laki" required'); ?>

							</div>
							<div class="col-md-4">
								<?php echo form_input('kapasitas_p',$edit_data['kapasitas_p'],'class="form-control perempuan" id="kapasitas_p" placeholder="Kapasitas Bed Perempuan" required'); ?>

							</div>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Terpakai','terpakai'); ?>

						<div class="row">
							<div class="col-md-4">
								<?php echo form_input('terpakai_l',$edit_data['terpakai_l'],'class="form-control form-control-sm laki-laki" id="terpakai_l" placeholder="Bed Terpakai Laki-laki" required'); ?>

							</div>
							<div class="col-md-4">
								<?php echo form_input('terpakai_p',$edit_data['terpakai_p'],'class="form-control form-control-sm perempuan" id="terpakai_p" placeholder="Bed Terpakai Perempuan" required'); ?>

							</div>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_submit('save','Simpan','class="btn btn-primary btn-sm"'); ?>

						<?php echo form_reset('reset','Reset','class="btn btn-warning btn-sm"'); ?>

						<?php echo anchor(base_url('panel/rumah_sakit/bed'),'Back','class="btn btn-danger sm"'); ?>

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
	<script type="text/javascript">
		var laki=$('.laki-laki');
		var perempuan=$('.perempuan');
		var k_l=$('#kapasitas_l');
		var k_p=$('#kapasitas_p');
		var p_l=$('#terpakai_l');
		var p_p=$('#terpakai_p');
		function reset_input(){
			k_l.val('0');
			k_p.val('0');
			p_l.val('0');
			p_p.val('0');
		}
		var changed=0;
		$('#kelas').change(function(event){
			console.log($(this).find(':selected').attr('data-unigender'));
			if($(this).find(':selected').attr('data-unigender')==1){
				perempuan.hide();
				k_l.attr('placeholder','Kapasitas');
				p_l.attr('placeholder','Terpakai');
				if(changed>0)
					reset_input();
			}else{
				perempuan.show();
				k_l.attr('placeholder','Kapasitas Bed Laki-laki');
				p_l.attr('placeholder','Terpakai Bed Laki-laki');
				if(changed>0)
					reset_input();
			}
			changed++;
		});
		$('#kelas').trigger('change');
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.panel_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>