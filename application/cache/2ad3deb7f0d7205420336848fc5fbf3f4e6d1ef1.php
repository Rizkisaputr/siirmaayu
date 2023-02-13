<?php $__env->startSection('content'); ?>
	<div id="content" class="content">
	<ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Ubah Data Pasien</li>
    </ol>
    <h1 class="page-header f-s-16 f-w-500">Ubah Data Perujuk dan Pasien</h1>
	<div class="row">
		<div class="col-lg-12">
			<div class="panelruj panel-inverse">
				<?php echo form_open('','role="form"'); ?>


                <input type="hidden" name="pasien_type" value="old">
                <input type="hidden" name="no_rm" value="<?php echo e($edit_data['no_rm']); ?>">
                <div class="panel-body">
                    <form>
                        <div class="row">
                            <div class="col-lg-6">
                                <h1 class="page-header f-s-16 f-w-500">Data Pengirim Rujukan</h1>
                                <hr class="m-t-0">
                                 <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Media Rujukan</label>
                                                <div class="col-md-10">
                                                    <div class="radio radio-css radio-inline">
                                                        <input type="radio" name="media" id="media8" value="Tanpa CC" />
                                                        <label for="media8"><b>Tidak via CC</b></label>
                                                    </div>
                                                    <div class="radio radio-css radio-inline">
                                                        <input type="radio" name="media" id="media1" value="Telpon CC" />
                                                        <label for="media1">Telpon CC PSC</label>
                                                    </div>
                                                    <div class="radio radio-css radio-inline">
                                                        <input type="radio" name="media" id="media2" value="Dispatch NCC" />
                                                        <label for="media2">Tlpn dari NCC</label>
                                                    </div>                                                      
                                                    <div class="radio radio-css radio-inline">
                                                        <input type="radio" name="media" id="media3" value="SMS" checked>
                                                        <label for="media3">SMS</label>
                                                    </div>                                                
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media4" value="Whatsapp" />
	                                                    <label for="media4">Whatsapp</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media5" value="Whatsapp Gateway" />
	                                                    <label for="media5">Whatsapp Gateway</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media6" value="Web" />
	                                                    <label for="media6">Web</label>
	                                                </div>                                                                   
                                                    <div class="radio radio-css radio-inline">
                                                        <input type="radio" name="media" id="media7" value="Lainnya" />
                                                        <label for="media7">Lainnya</label>
                                                    </div>                                                 
                                                </div>
                                </div>
                                <h1 class="page-header f-s-16 f-w-500">Fasilitas Kesehatan</h1>
                                <hr class="m-t-0">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Asal Pasien</label>
                                    <div class="col-md-10">
                                        <?php echo form_dropdown('id_rs_perujuk',$perujuk,$edit_data['id_rs_perujuk'],'class="form-control default-select2" id="id_rs_perujuk" required style="width: 50%"'); ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Nama</label>
                                    <div class="col-md-10">
                                       <?php echo form_input('nama',$pasien->nama,'class="form-control form-control-sm new_group" id="kontak" placeholder="Nama Pasien" style="width: 50%"'); ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Umur</label>
                                    <div class="col-md-10">
                                       <?php echo form_input('umur',$pasien->umur,'class="form-control form-control-sm new_group" id="kontak" placeholder="Umur" style="width: 50%"'); ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Penanggung Jwb</label>
                                    <div class="col-md-10">
                                       <?php echo form_input('pasangan',$pasien->pasangan,'class="form-control form-control-sm new_group" id="kontak" placeholder="Nama Penanggung Jwb" style="width: 50%"'); ?>

                                    </div>
                                </div>
                                <!--<div class="form-group row">
                                    <label class="col-form-label col-md-2">Kontak</label>
                                    <div class="col-md-10">
                                        <?php echo form_input('kontak',$pasien->kontak,'class="form-control form-control-sm new_group" id="kontak" placeholder="Kontak Pasien"'); ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Tempat Lahir</label>
                                    <div class="col-md-10">
                                            <?php echo form_input('tempat_lahir',$pasien->tempat_lahir,'class="form-control form-control-sm new_group" id="tempat_lahir" placeholder="Tempat Lahir"'); ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Tanggal Lahir</label>
                                    <div class="col-md-10">
                                        <?php echo form_input('tgl_lahir',$pasien->tgl_lahir,'class="form-control form-control-sm new_group" id="tgl_lahir" placeholder="Tanggal Lahir Pasien"'); ?>

                                    </div>
                                </div>-->
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Jenis kelamin</label>
                                    <div class="col-md-10">
                                        <?php echo form_dropdown('jenis_kelamin',array('Laki-laki'=>'Laki-laki', 'Perempuan'=>'Perempuan'),$pasien->jenis_kelamin,'class="form-control form-control-sm new_group default-select2" id="jenis_kelamin" placeholder="Kontak Pasien" style="width: 50%"'); ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">NIK</label>
                                    <div class="col-md-10">
                                        <?php echo form_input('nik',$pasien->nik,'class="form-control form-control-sm new_group" id="nik" placeholder="NIK Pasien" style="width: 50%"'); ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Alamat</label>
                                    <div class="col-md-10">
                                        <?php echo form_input('alamat',$pasien->alamat,'class="form-control form-control-sm new_group" id="alamat" placeholder="Alamat Pasien" required style="width: 50%"'); ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Nomor WA Perujuk (mulai dgn 62)</label>
                                    <div class="col-md-10">
                                    <?php echo form_input('wa_rujukan',$edit_data['wa_rujukan'],'class="form-control" id="kontak" placeholder="Mulailah dengan 62, contoh 628112111828" style="width: 50%"'); ?>

                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-form-label col-md-2">Nomor SMS Perujuk</label>
                                    <div class="col-md-10">
                                    <?php echo form_input('sms_rujukan',$edit_data['sms_rujukan'],'class="form-control" id="kontak" placeholder="Mulailah dengan 62, contoh 628112111828" style="width: 50%"'); ?>

                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-form-label col-md-2">Nomor Telpon Perujuk</label>
                                    <div class="col-md-10">
                                    <?php echo form_input('ibuanak_nobidan',$edit_data['ibuanak_nobidan'],'class="form-control" id="kontak" placeholder="Mulailah dengan 62, contoh 628112111828" style="width: 50%"'); ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Kelas Bed</label>
                                    <div class="col-md-10">
                                        <?php echo form_dropdown('id_kelas_bed',$kelas_bed_select,$edit_data['id_kelas_bed'],'class="form-control default-select2" id="id_kelas_bed" required style="width: 50%"'); ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">layanan RS</label>
                                    <div class="col-md-10">
                                        <?php echo form_dropdown('id_jenis_layanan',$layanan_select,$edit_data['id_jenis_layanan'],'class="form-control default-select2" id="id_jenis_layanan" required style="width: 50%"'); ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Tujuan</label>
                                    <div class="col-md-10">
                                        <?php echo form_dropdown('id_rs_dirujuk',$dirujuk,$edit_data['id_rs_dirujuk'],'class="form-control default-select2" id="id_rs_dirujuk" required style="width: 50%"'); ?>

                                    </div>
                                </div>
                                
                                 <div class="form-group row">
                                    <label class="col-form-label col-md-2">Transportasi</label>
                                    <div class="col-md-10">
                                        <?php echo form_input('transportasi',$edit_data['transportasi'],'class="form-control" style="width: 50%"'); ?>

                                    </div>
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div><br><br><br><br><br><br><br><br></div>
                                <h1 class="page-header f-s-16 f-w-500">Resume Medis Pasien</h1>
                                <hr class="m-t-0">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Alasan Rujukan</label>
                                    <div class="col-md-10">
                                        <?php echo form_input('alasan_rujukan',$edit_data['alasan_rujukan'],'class="form-control" style="width: 70%"'); ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Diagnosa</label>
                                    <div class="col-md-10">
                                        <?php echo form_input('diagnosis',$edit_data['diagnosis'],'class="form-control"'); ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">ICD X</label>
                                    <div class="col-md-10">
                                    <select name="ibuanak_icdx" class="cb-icdx form-control form-control-sm" style="width: 70%"></select></div>
                                     <!--<?php echo form_input('ibuanak_icdx',$edit_data['ibuanak_icdx'],'class="cb-icdx form-control form-control-sm"'); ?>-->
                                </div>
                                <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Kesadaran</label>
	                                            <div class="col-md-10">
	                                                <?php echo form_dropdown('kesadaran',array(
														'Composmentis' => 'Composmentis', 
														'Apatis' => 'Apatis',   
														'Delirium' => 'Delirium', 
														'Somnolen' => 'Somnolen',
														'Sopor' => 'Sopor', 
														'Semi-coma' => 'Semi-coma',
														'Coma' => 'Coma'),'','class="form-control default-select2"  required style="width: 50%"'); ?>

	                                            </div>
	                            </div>
	                            <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Tensi</label>
	                                            <div class="col-md-10">
	                                                <!--<?php echo form_input('tensi','','class="form-control"'); ?>-->
	                                                <?php echo form_input('tensi',$edit_data['tensi'],'class="form-control"  required style="width: 50%"'); ?>

	                                            </div>
	                            </div>
	                            <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Nadi</label>
	                                            <div class="col-md-10">
	                                                <!--<?php echo form_input('nadi','','class="form-control"'); ?>-->
	                                                <?php echo form_input('nadi',$edit_data['nadi'],'class="form-control"  required style="width: 50%"'); ?>

	                                            </div>
	                            </div>
	                            <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Suhu</label>
	                                            <div class="col-md-10">
	                                                <!--<?php echo form_input('suhu','','class="form-control"'); ?>-->
	                                                <?php echo form_input('suhu',$edit_data['suhu'],'class="form-control"  required style="width: 50%"'); ?>

	                                            </div>
	                            </div>
	                           <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Pernapasan</label>
	                                            <div class="col-md-10">
	                                                <!--<?php echo form_input('pernapasan','','class="form-control"'); ?>-->
	                                                <?php echo form_input('pernapasan',$edit_data['pernapasan'],'class="form-control"  required style="width: 50%"'); ?>

	                                            </div>
	                            </div>
	                            <div class="form-group row">
	                                            <label class="col-form-label col-md-2">GCS</label>
	                                            <div class="col-md-10">
												<?php echo form_dropdown('nyeri',array('1'=>'1', '2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15'),'','class="form-control default-select2" required style="width: 50%"'); ?>

	                                            </div>
	                            </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Keterangan Lain</label>
                                    <div class="col-md-10">
                                    <?php echo form_input('keterangan_lain',$edit_data['keterangan_lain'],'class="form-control" required style="width: 50%"'); ?>

                                    </div>
                                </div>
	                            <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Hasil Lab</label>
	                                            <div class="col-md-10">
	                                               <!-- <?php echo form_input('hasil_lab','','class="form-control"'); ?>-->
	                                                <?php echo form_input('hasil_lab',$edit_data['hasil_lab'],'class="form-control"  required style="width: 50%"'); ?>

	                                            </div>
	                            </div>
	                            <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Pemeriksaan Penunjang</label>
	                                            <div class="col-md-10">
	                                               <!-- <?php echo form_input('hasil_radiologi_ekg','','class="form-control"'); ?>-->
	                                                <?php echo form_input('hasil_radiologi_ekg',$edit_data['hasil_radiologi_ekg'],'class="form-control"  required style="width: 50%"'); ?>

	                                            </div>
	                            </div>
                                
                                
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Tindakan</label>
                                    <div class="col-md-10">
                                        <?php echo form_input('tindakan',$edit_data['tindakan'],'class="form-control"'); ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Pembiayaan</label>
                                    <div class="col-md-10">
                                        <?php echo form_dropdown('pembiayaan',$pembiayaan_select,$edit_data['pembiayaan'],'class="form-control default-select2" required style="width: 70%"'); ?>

                                    </div>
                                </div>
                                
                            </div>  
                        </div>
                        <hr class="m-t-0">
                        <div class="form-group row text-right">
                            <div class="col-md-12">
                                <?php echo form_submit('save','Simpan','class="btn btn-primary btn-sm"'); ?>

								<?php echo form_reset('reset','Reset','class="btn btn-warning btn-sm"'); ?>

								<!--<?php echo anchor(base_url('panel/rujukan/rujuk'),'Back','class="btn btn-danger btn-sm"'); ?>-->
                                <?php echo anchor(base_url('panel/data_rujukan'),'Back','class="btn btn-danger btn-sm"'); ?>

                            </div>
                        </div>
                    </form>
                </div>            
				<?php echo form_close(); ?>

			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
	<?php echo $__env->make('partials.toastr_msg', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<!-- InputMask -->
	<script src="<?php echo e(load_asset('plugins/input-mask/jquery.inputmask.js')); ?>"></script>
	<script src="<?php echo e(load_asset('plugins/input-mask/jquery.inputmask.date.extensions.js')); ?>"></script>
	<script src="<?php echo e(load_asset('plugins/input-mask/jquery.inputmask.extensions.js')); ?>"></script>
	<script src="<?php echo e(load_asset('bower_components/select2/dist/js/select2.full.min.js')); ?>"></script>
	<script type="text/javascript">
		$(function(){
			$('input[type=radio][name=pasien_type]').change(function() {
				refresh_form(this.value);
			});
			$('#select_pasien').select2({
				placeholder: 'Cari Pasien berdasarkan nama/nik',
				minimumInputLength:1,
				ajax: {
					url: "<?php echo e(base_url('panel/rujukan/pasien_list')); ?>",
					dataType: 'json',
					delay: 250,
					data: function(params){
						return {
							q: params.term
						}
					},
					processResults: function(data, params){
						var output=[];
						data.forEach(function(val,index){
							output.push({
								id:val.id_rm,
								text: val.nama+'| NIK: '+val.nik+'| Alamat: '+val.alamat
							});
						});
						return {
							results:output
						};
					},
					cache: true
				}
			});
            $('.cb-icdx').select2({
                placeholder: 'Kode ICD X',
                minimumInputLength:1,
                ajax: {
                    url: "<?php echo e(base_url('panel/rujukan/icdx_list')); ?>",
                    dataType: 'json',
                    delay: 250,
                    data: function(params){
                        return {
                            q: params.term
                        }
                    },
                    processResults: function(data, params){
                        var output=[];
                        data.forEach(function(val,index){
                            output.push({
                                id:val.kode,
                                //kode:val.kode,
                                text: val.kode+' '+val.keterangan
                            });
                        });
                        return {
                            results:output
                        };
                    },
                    cache: true
                }

            });
			$('.default-select2').select2();
			refresh_form($('input[type=radio][name=pasien_type]:checked').val());
			$('#tgl_lahir').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
			$("#id_rs.perujuk").change(refresh_rs_select);
			$("#id_kelas_bed").change(refresh_rs_select);
			$("#id_jenis_layanan").change(refresh_rs_select);
		});
		function refresh_form(type){
			$('.new_group').attr('disabled',type!=='new');
			$('.old_group').attr('disabled',type!=='old');
		}
		function refresh_rs_select() {
			var $sel=$("#id_rs_dirujuk");
			var id_perujuk=$("#id_rs_perujuk").val();
			var id_kelas_bed=$("#id_kelas_bed").val();
			var id_jenis_layanan=$("#id_jenis_layanan").val();
			$sel.empty();
			Pace.restart()
			$.post("<?php echo e(base_url('panel/rujukan/rujuk/recommend')); ?>/"+id_perujuk,{
				'id_kelas_bed': id_kelas_bed,
				'id_jenis_layanan': id_jenis_layanan
			},function(res){
				$.each(res,function(key,value){
					$sel.append($("<option></option>").attr('value',value.id_rs).text(value.nama+'('+Number(value.distance_in_km).toPrecision(3)+' KM)'));
				});
			});
		}
	</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('head'); ?>
	<link rel="stylesheet" href="<?php echo e(load_asset('bower_components/select2/dist/css/select2.min.css')); ?>">
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.panel_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>