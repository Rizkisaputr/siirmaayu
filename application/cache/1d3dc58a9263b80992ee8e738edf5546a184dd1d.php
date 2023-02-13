<?php $__env->startSection('content'); ?>
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Halaman : </a></li>
        <li class="breadcrumb-item active"><b>Menjawab Rujukan</b></li>
    </ol>
	<h1 class="page-header f-s-14 f-w-500"><b>Resume Medis Pasien yang Dirujuk</b></h1>

	  <div class="row">
	  	<div class="col-md-12">
	  		<?php if($detil_rujukan['type'] == 2): ?>
	      <div class="panelruj1 panel-inverse">
	      	<div class="row">
	      		<div class="col-md-4">
	              <dl class="row p-5">
	                <dt class="col-sm-4 text-truncate">Nama ibu</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['pasien']) ? $detil_rujukan['pasien'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">NIK ibu</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['nik']) ? $detil_rujukan['nik'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Umur</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['umur']) ? $detil_rujukan['umur'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Nama Suami</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['pasangan']) ? $detil_rujukan['pasangan'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Golongan Darah</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['goldarah']) ? $detil_rujukan['goldarah'] : '-'); ?></dd>
	              </dl>
		        </div>
		        <div class="col-md-4">
	              <dl class="row p-5">
	                <dt class="col-sm-4 text-truncate">Nomor Bidan</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['ibuanak_nobidan']) ? $detil_rujukan['ibuanak_nobidan'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Nama Bidan</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['ibuanak_namabidan']) ? $detil_rujukan['ibuanak_namabidan'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Kode Praktik</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['ibukanak_kodebidan']) ? $detil_rujukan['ibukanak_kodebidan'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Puskesmas Asal</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['perujuk']) ? $detil_rujukan['perujuk'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Puskesmas Tujuan</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['dirujuk']) ? $detil_rujukan['dirujuk'] : '-'); ?></dd>
	              </dl>
		        </div>
		        <div class="col-md-4">
	              <dl class="row p-5">
	                <dt class="col-sm-4 text-truncate">Diagnosa</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['diagnosis']) ? $detil_rujukan['diagnosis'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Kode ICDX</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['ibuanak_icdx']) ? $detil_rujukan['ibuanak_icdx'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Pemeriksaan Penunjang</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['alasan_rujukan']) ? $detil_rujukan['alasan_rujukan'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Tindakan Pra Rujukan</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['tindakan']) ? $detil_rujukan['tindakan'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Asuransi</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['pembiayaan']) ? $detil_rujukan['pembiayaan'] : '-'); ?></dd>
	              </dl>
		        </div>	
		    </div>
	        
	        <!-- /.box-body -->
	      </div>
	      <!-- /.box -->

	      <?php else: ?> 

	      <div class="panelruj2 panel-inverse">
	      	<div class="row">
	      		<div class="col-md-4">
	              <dl class="row p-5">
	                <dt class="col-sm-4 text-truncate">Pasien</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['pasien']) ? $detil_rujukan['pasien'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Alasan Rujukan</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['Alasan Rujukan']) ? $detil_rujukan['Alasan Rujukan'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Kesadaran</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['kesadaran']) ? $detil_rujukan['kesadaran'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Tensi</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['tensi']) ? $detil_rujukan['tensi'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Nadi</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['nadi']) ? $detil_rujukan['nadi'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Suhu</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['suhu']) ? $detil_rujukan['suhu'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Pernafasan</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['pernafasan']) ? $detil_rujukan['pernafasan'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Diagnosis</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['diagnosis']) ? $detil_rujukan['diagnosis'] : '-'); ?></dd>
	              </dl>
		        </div>
		        <div class="col-md-4">
	              <dl class="row p-5">
	                <dt class="col-sm-4 text-truncate">GCS</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['nyeri']) ? $detil_rujukan['nyeri'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Keterangan Lain</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['Keterangan Lain']) ? $detil_rujukan['Keterangan Lain'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Hasil Lab</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['Hasil Lab']) ? $detil_rujukan['Hasil Lab'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Hasil Radiologi</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['Hasil Radiologi']) ? $detil_rujukan['Hasil Radiologi'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Tindakan</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['tindakan']) ? $detil_rujukan['tindakan'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Status Rujukan</dt>
	                <dd class="col-sm-8" style="color: red;"><?php echo e(isset($detil_rujukan['Status Rujukan']) ? $detil_rujukan['Status Rujukan'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Dibuat</dt>
	                <dd class="col-sm-8" style="color: red;"><?php echo e(date('d M Y H:i:s',strtotime($detil_rujukan['dibuat']))); ?></dd>
	                <dt class="col-sm-4 text-truncate">Perujuk</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['perujuk']) ? $detil_rujukan['perujuk'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Tujuan Rujukan</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['dirujuk']) ? $detil_rujukan['dirujuk'] : '-'); ?> 
	                	<?php if($detil_rujukan['pengalih'] != NULL): ?>
	                		<i>(Dialihkan dari <?php echo e($detil_rujukan['pengalih']); ?>)</i>
	                	<?php endif; ?>
	                </dd>
	              </dl>
		        </div>
		        <div class="col-md-4">
	              <dl class="row p-5">
	                <dt class="col-sm-4 text-truncate">Kelas Bed</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['Kelas Bed']) ? $detil_rujukan['Kelas Bed'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Layanan</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['Layanan']) ? $detil_rujukan['Layanan'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Transportasi</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['transportasi']) ? $detil_rujukan['transportasi'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Pembiayaan</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['pembiayaan']) ? $detil_rujukan['pembiayaan'] : '-'); ?></dd>
	                <dt class="col-sm-4 text-truncate">Lampiran 1</dt>
	                <dd class="col-sm-8">
	                	<?php if($detil_rujukan['attachment_1'] != NULL): ?>
	                		<a href="<?php echo e(load_asset('public/'.$detil_rujukan['attachment_1'])); ?>" type="" class="btn btn-primary btn-xs" target="_blank">Download</a>
	                	<?php else: ?>
	                		Tidak Ada
	                	<?php endif; ?>
					</dd>
	                <dt class="col-sm-4 text-truncate">Lampiran 2</dt>
	                <dd class="col-sm-8"><?php if($detil_rujukan['attachment_2'] != NULL): ?>
	                		<a href="<?php echo e(load_asset('public/'.$detil_rujukan['attachment_2'])); ?>" type="" class="btn btn-primary btn-xs" target="_blank">Download</a>
	                	<?php else: ?>
	                		Tidak Ada
	                	<?php endif; ?>
	                </dd>
	                <dt class="col-sm-4 text-truncate">Lampiran 3</dt>
	                <dd class="col-sm-8"><?php if($detil_rujukan['attachment_3'] != NULL): ?>
	                		<a href="<?php echo e(load_asset('public/'.$detil_rujukan['attachment_3'])); ?>" type="" class="btn btn-primary btn-xs" target="_blank">Download</a>
	                	<?php else: ?>
	                		Tidak Ada
	                	<?php endif; ?></dd>
	                <dt class="col-sm-4 text-truncate">Hasil Lab</dt>
	                <dd class="col-sm-8"><?php echo e(isset($detil_rujukan['Hasil Lab']) ? $detil_rujukan['Hasil Lab'] : '-'); ?></dd>
	              </dl>
		        </div>	
		    </div>
	        
	        <!-- /.box-body -->
	      </div>
	      <!-- /.box -->
	      <?php endif; ?>
	    </div>
	    <!-- ./col -->
	  </div>
      <!-- /.row -->
      <h1 class="page-header f-s-14 f-w-500"><b>Form Respon Jawaban Rujukan</b></h1>
      <div class="row">
      	  <div class="col-lg-12">
	        <div class="panel panel-inverse">
	          <div class="panel-body form-horizontal">
	            <form action="" method="post" accept-charset="utf-8">
	              <div class="form-group">
	                <?php echo form_label('Status Rujukan','status rujukan'); ?>

                    <select name="status_rujukan" class="form-control form-control-sm" id="status_rujukan" placeholder="Status Rujukan" required style="width: 30%">
                      <option value="Diterima">Diterima</option>
                      <option value="Ditolak">Ditolak</option>
                      <option value="Dialihkan">Dialihkan ke RS lain</option>
                    </select>
	              </div>
	              <div class="form-group pengalih">
					 <label for="id_rs" class=""><b>Dialihkan ke : </b> </label>
                  	<input type="hidden" name="id_rs_pengalih" value="<?php echo e($detil_rujukan['id_dirujuk']); ?>">
					<?php echo form_dropdown('id_rs_dirujuk',$selection_rs,'','class="form-control form-control-sm" id="id_rs" required style="width: 30%"'); ?>

				</div>
	              <div class="form-group">
	                <label for="info_rujuk_balik" class="">Advis / Alasan</label>
	                  <textarea name="info_rujuk_balik" cols="40" rows="3" class="form-control" id="info_rujuk_balik" placeholder="Advis/Alasan" required style="width: 30%"></textarea>
	              </div>
	              <div class="footer-content bg-silver">
	              	<?php echo anchor(base_url('panel/data_rujukan'),'<i class="fas fa-arrow-alt-circle-left"></i> Back','class="btn btn-sm btn-danger"'); ?>

	                <input type="submit" name="save" value="Simpan" class="btn btn-primary btn-sm">
	              </div>
	            </form>
	          </div>
	        </div>
	      </div>
      </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
	<?php echo $__env->make('partials.toastr_msg', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<script src="<?php echo e(load_asset('bower_components/select2/dist/js/select2.full.min.js')); ?>"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#id_rs').select2();
			$('#status_rujukan').change(function() {
				if ($(this).val() == "Dialihkan")
				{
					$('.pengalih').show();
				} else {
					$('.pengalih').hide();
				}
			});
		});
	</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('head'); ?>
<link rel="stylesheet" href="<?php echo e(load_asset('bower_components/select2/dist/css/select2.min.css')); ?>">
<?php $__env->stopSection(); ?>

<style type="text/css">
	.dl-horizontal dt {
		text-align: left !important;
	}
	.dl-horizontal dd {
	    margin-left: 160px!important;
	}

	.pengalih { display: none; }
</style>

<?php echo $__env->make('layouts.panel_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>