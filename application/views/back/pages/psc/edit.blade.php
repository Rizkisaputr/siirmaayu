@extends('layouts.panel_layout')

@section('content')
	{!! form_open() !!}
	<ul class="timeline">
		<li id="part-pasien">
			<!-- timeline icon -->
			<i class="fa fa-user bg-blue"></i>
			<div class="timeline-item">
				<h3 class="timeline-header"><a href="javascript:void(0)">Data pasien</a></h3>
				<div class="timeline-body">
					<div class="radio">
						<label>
							<input type="radio" name="pasien_type" id="pasien_type_old" value="old" checked>
							Pasien Lama
						</label>
						<div class="row">
							<div class="col-md-12 form-horizontal">
								{!! form_label('Pasien','select_pasien','class="col-sm-2 control-label"') !!}
								<div class="col-sm-10">
									{!! form_dropdown('no_rm',$selected_user_select,$edit_data['no_rm'],'class="form-control old_group" id="select_pasien"') !!}
								</div>
							</div>
						</div>
					</div>
					<div class="radio">
						<label>
							<input type="radio" name="pasien_type" id="pasien_type_new" value="new">
							Pasien Baru
						</label>
						<div class="row">
							<div class="col-md-12 form-horizontal">
								<div class="form-group">
									{!! form_label('Nama','nama','class="col-sm-2 control-label"') !!}
									<div class="col-sm-10">
										{!! form_input('nama','','class="form-control new_group" id="kontak" placeholder="Nama Pasien"') !!}
									</div>
								</div>
								<div class="form-group">
									{!! form_label('Kontak','kontak','class="col-sm-2 control-label"') !!}
									<div class="col-sm-10">
										{!! form_input('kontak','','class="form-control new_group" id="kontak" placeholder="Kontak Pasien"') !!}
									</div>
								</div>
								<div class="form-group">
									{!! form_label('Tanggal Lahir','tgl_lahir','class="col-sm-2 control-label"') !!}
									<div class="col-sm-10">
										{!! form_input('tgl_lahir','','class="form-control new_group" id="tgl_lahir" placeholder="Tanggal Lahir Pasien"') !!}
									</div>
								</div>
								<div class="form-group">
									{!! form_label('Tempat Lahir','tempat_lahir','class="col-sm-2 control-label"') !!}
									<div class="col-sm-10">
										{!! form_input('tempat_lahir','','class="form-control new_group" id="tempat_lahir" placeholder="Tempat Lahir"') !!}
									</div>
								</div>
								<div class="form-group">
									{!! form_label('Jenis Kelamin','jenis_kelamin','class="col-sm-2 control-label"') !!}
									<div class="col-sm-10">
										{!! form_dropdown('jenis_kelamin',array('Laki-laki'=>'Laki-laki', 'Perempuan'=>'Perempuan'),'','class="form-control new_group" id="jenis_kelamin" placeholder="Kontak Pasien"') !!}
									</div>
								</div>
								<div class="form-group">
									{!! form_label('NIK','nik','class="col-sm-2 control-label"') !!}
									<div class="col-sm-10">
										{!! form_input('nik','','class="form-control new_group" id="nik" placeholder="NIK Pasien"') !!}
									</div>
								</div>
								<div class="form-group">
									{!! form_label('Alamat','alamat','class="col-sm-2 control-label"') !!}
									<div class="col-sm-10">
										{!! form_textarea('alamat','','class="form-control new_group" id="alamat" placeholder="Alamat Pasien"') !!}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</li>
		<li id="part-tujuan">
			<i class="fa fa-hospital-o bg-red"></i>
			<div class="timeline-item">
				<h3 class="timeline-header"><a href="javascript:void(0)">Fasilitas Kesehatan</a></h3>
				<div class="timeline-body form-horizontal">
					<div class="form-group">
						{!! form_label('Asal','id_rs_perujuk','class="col-sm-2 control-label"') !!}
						<div class="col-sm-10">
							{!! form_dropdown('id_rs_perujuk',$perujuk,$edit_data['id_rs_perujuk'],'class="form-control default-select2" id="id_rs_perujuk" required') !!}
						</div>
					</div>
					<div class="form-group">
						{!! form_label('Kelas Bed','id_kelas_bed','class="col-sm-2 control-label"') !!}
						<div class="col-sm-10">
							{!! form_dropdown('id_kelas_bed',$kelas_bed_select,$edit_data['id_kelas_bed'],'class="form-control default-select2" id="id_kelas_bed" required') !!}
						</div>
					</div>
					<div class="form-group">
						{!! form_label('Layanan RS','id_jenis_layanan','class="col-sm-2 control-label"') !!}
						<div class="col-sm-10">
							{!! form_dropdown('id_jenis_layanan',$layanan_select,$edit_data['id_jenis_layanan'],'class="form-control default-select2" id="id_jenis_layanan" required') !!}
						</div>
					</div>
					<div class="form-group">
						{!! form_label('Tujuan','id_rs_dirujuk','class="col-sm-2 control-label"') !!}
						<div class="col-sm-10">
							{!! form_dropdown('id_rs_dirujuk',$dirujuk,$edit_data['id_rs_dirujuk'],'class="form-control default-select2" id="id_rs_dirujuk" required') !!}
						</div>
					</div>
				</div>
			</div>
		</li>
		<li id="part-rujukan">
			<!-- timeline icon -->
			<i class="fa fa-pencil bg-blue"></i>
			<div class="timeline-item">
				<h3 class="timeline-header"><a href="javascript:void(0)">Resume pasien</a></h3>

				<div class="timeline-body form-horizontal">
					<div class="form-group">
						{!! form_label('Transportasi','transportasi','class="col-sm-2 control-label"') !!}
						<div class="col-sm-10">
							{!! form_input('transportasi',$edit_data['transportasi'],'class="form-control"') !!}
						</div>
					</div>
					<div class="form-group">
						{!! form_label('Alasan Rujukan','alasan_rujukan','class="col-sm-2 control-label"') !!}
						<div class="col-sm-10">
							{!! form_input('alasan_rujukan',$edit_data['alasan_rujukan'],'class="form-control"') !!}
						</div>
					</div>
					<div class="form-group">
						{!! form_label('Diagnosis','diagnosis','class="col-sm-2 control-label"') !!}
						<div class="col-sm-10">
							{!! form_input('diagnosis',$edit_data['diagnosis'],'class="form-control"') !!}
						</div>
					</div>
					<div class="form-group">
						{!! form_label('Kesadaran','kesadaran','class="col-sm-2 control-label"') !!}
						<div class="col-sm-10">
							{!! form_dropdown('kesadaran',array(
								'Composmentis' => 'Composmentis', 
								'Apatis' => 'Apatis',   
								'Delirium' => 'Delirium', 
								'Somnolen' => 'Somnolen',
								'Sopor' => 'Sopor', 
								'Semi-coma' => 'Semi-coma',
								'Coma' => 'Coma'),$edit_data['kesadaran'],'class="form-control"') !!}
						</div>
					</div>
					<div class="form-group">
						{!! form_label('Tensi','tensi','class="col-sm-2 control-label"') !!}
						<div class="col-sm-10">
							{!! form_input('tensi',$edit_data['tensi'],'class="form-control"') !!}
						</div>
					</div>
					<div class="form-group">
						{!! form_label('Nadi','nadi','class="col-sm-2 control-label"') !!}
						<div class="col-sm-10">
							{!! form_input('nadi',$edit_data['nadi'],'class="form-control"') !!}
						</div>
					</div>
					<div class="form-group">
						{!! form_label('Suhu','suhu','class="col-sm-2 control-label"') !!}
						<div class="col-sm-10">
							{!! form_input('suhu',$edit_data['suhu'],'class="form-control"') !!}
						</div>
					</div>
					<div class="form-group">
						{!! form_label('Pernapasan','pernapasan','class="col-sm-2 control-label"') !!}
						<div class="col-sm-10">
							{!! form_input('pernapasan',$edit_data['pernapasan'],'class="form-control"') !!}
						</div>
					</div>
					<div class="form-group">
						{!! form_label('Nyeri','nyeri','class="col-sm-2 control-label"') !!}
						<div class="col-sm-10">
							{{--							{!! form_input('nyeri','','class="form-control"') !!}--}}
							{!! form_dropdown('nyeri',array('Tidak nyeri'=>'Tidak nyeri', 'Nyeri ringan'=>'Nyeri ringan','Nyeri berat'=>'Nyeri berat'),$edit_data['nyeri'],'class="form-control"') !!}
						</div>
					</div>
					<div class="form-group">
						{!! form_label('Keterangan Lain','keterangan_lain','class="col-sm-2 control-label"') !!}
						<div class="col-sm-10">
							{!! form_input('keterangan_lain',$edit_data['keterangan_lain'],'class="form-control"') !!}
						</div>
					</div>
					<div class="form-group">
						{!! form_label('Hasil Lab','hasil_lab','class="col-sm-2 control-label"') !!}
						<div class="col-sm-10">
							{!! form_input('hasil_lab',$edit_data['hasil_lab'],'class="form-control"') !!}
						</div>
					</div>
					<div class="form-group">
						{!! form_label('Hasil Radiologi','hasil_radiologi_ekg','class="col-sm-2 control-label"') !!}
						<div class="col-sm-10">
							{!! form_input('hasil_radiologi_ekg',$edit_data['hasil_radiologi_ekg'],'class="form-control"') !!}
						</div>
					</div>
					<div class="form-group">
						{!! form_label('Tindakan','tindakan','class="col-sm-2 control-label"') !!}
						<div class="col-sm-10">
							{!! form_input('tindakan',$edit_data['tindakan'],'class="form-control"') !!}
						</div>
					</div>
					<div class="form-group">
						{!! form_label('Pembiayaan','pembiayaan','class="col-sm-2 control-label"') !!}
						<div class="col-sm-10">
							{!! form_dropdown('pembiayaan',$pembiayaan_select,$edit_data['pembiayaan'],'class="form-control"') !!}
						</div>
					</div>
				</div>
			</div>
		</li>
		<li id="part-attachment">
			<!-- timeline icon -->
			<i class="fa fa-paperclip bg-green"></i>
			<div class="timeline-item">
				<h3 class="timeline-header"><a href="javascript:void(0)">Attachment</a></h3>
				<div class="timeline-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								{!! form_label('Lampiran 1','attachment_1') !!}
								{!! form_upload('attachment_1','','id="attachment_1"') !!}
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								{!! form_label('Lampiran 2','attachment_2') !!}
								{!! form_upload('attachment_2','','id="attachment_2"') !!}
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								{!! form_label('Lampiran 3','attachment_3') !!}
								{!! form_upload('attachment_3','','id="attachment_3"') !!}
							</div>
						</div>
						<p class="help-block" style="margin-left: 20px;">File maksimal 2MB dengan format yang diizinkan gif,jpg,png,docx,doc,xls,xlsx, atau pdf</p>
					</div>
				</div>
			</div>
		</li>
		<li id="part-final">
			<!-- timeline icon -->
			<i class="fa fa-wrench bg-blue"></i>
			<div class="timeline-item">
				<h3 class="timeline-header"><a href="javascript:void(0)">Aksi</a></h3>

				<div class="timeline-body">
					{!! form_submit('save','Simpan','class="btn btn-primary"') !!}
					{!! form_reset('reset','Reset','class="btn btn-warning"') !!}
					{!! anchor(base_url('panel/rujukan/rujuk'),'Back','class="btn btn-danger"') !!}
				</div>
			</div>
		</li>
		<li><i class="fa fa-send bg-green"></i></li>
	</ul>
	{!! form_close() !!}
@endsection

@section('script')
	@include('partials.toastr_msg')
	<!-- InputMask -->
	<script src="{{load_asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
	<script src="{{load_asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
	<script src="{{load_asset('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
	<script src="{{load_asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
	<script type="text/javascript">
		$(function(){
			$('input[type=radio][name=pasien_type]').change(function() {
				refresh_form(this.value);
			});
			$('#select_pasien').select2({
				placeholder: 'Cari Pasien berdasarkan nama/nik',
				minimumInputLength:1,
				ajax: {
					url: "{{base_url('panel/rujukan/pasien_list')}}",
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
			$.post("{{base_url('panel/rujukan/rujuk/recommend')}}/"+id_perujuk,{
				'id_kelas_bed': id_kelas_bed,
				'id_jenis_layanan': id_jenis_layanan
			},function(res){
				$.each(res,function(key,value){
					$sel.append($("<option></option>").attr('value',value.id_rs).text(value.nama+'('+Number(value.distance_in_km).toPrecision(3)+' KM)'));
				});
			});
		}
	</script>
@endsection

@section('head')
	<link rel="stylesheet" href="{{load_asset('bower_components/select2/dist/css/select2.min.css')}}">
@endsection
