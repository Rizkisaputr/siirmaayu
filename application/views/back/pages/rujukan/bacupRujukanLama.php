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
								{!! form_dropdown('no_rm','','','class="form-control old_group" id="select_pasien"') !!}
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
								{!! form_label('Kontak','telepon','class="col-sm-2 control-label"') !!}
								<div class="col-sm-10">
									{!! form_input('telepon','','class="form-control new_group" id="kontak" placeholder="Telepon Pasien"') !!}
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
									{!! form_dropdown('jenis_kelamin',array('Laki-laki'=>'Laki-laki', 'Perempuan'=>'Perempuan'),'','class="form-control new_group" id="jenis_kelamin" placeholder="Jenis Kelamin"') !!}
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
						{!! form_dropdown('id_rs_perujuk',$perujuk,'','class="form-control default-select2" id="id_rs_perujuk" required') !!}
					</div>
				</div>
				<div class="form-group">
					{!! form_label('Kelas Bed','id_kelas_bed','class="col-sm-2 control-label"') !!}
					<div class="col-sm-10">
						{!! form_dropdown('id_kelas_bed',$kelas_bed_select,'','class="form-control default-select2" id="id_kelas_bed" required') !!}
					</div>
				</div>
				<div class="form-group">
					{!! form_label('Layanan RS','id_jenis_layanan','class="col-sm-2 control-label"') !!}
					<div class="col-sm-10">
						{!! form_dropdown('id_jenis_layanan',$layanan_select,'','class="form-control default-select2" id="id_jenis_layanan" required') !!}
					</div>
				</div>
				<div class="form-group">
					{!! form_label('Tujuan','id_rs_dirujuk','class="col-sm-2 control-label"') !!}
					<div class="col-sm-10">
						{!! form_dropdown('id_rs_dirujuk',$dirujuk,'','class="form-control default-select2" id="id_rs_dirujuk" required') !!}
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
						{!! form_input('transportasi','','class="form-control"') !!}
					</div>
				</div>
				<div class="form-group">
					{!! form_label('Alasan Rujukan','alasan_rujukan','class="col-sm-2 control-label"') !!}
					<div class="col-sm-10">
						{!! form_input('alasan_rujukan','','class="form-control"') !!}
					</div>
				</div>
				<div class="form-group">
					{!! form_label('Diagnosis','diagnosis','class="col-sm-2 control-label"') !!}
					<div class="col-sm-10">
						{!! form_input('diagnosis','','class="form-control"') !!}
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
							'Coma' => 'Coma'),'','class="form-control"') !!}
					</div>
				</div>
				<div class="form-group">
					{!! form_label('Tensi','tensi','class="col-sm-2 control-label"') !!}
					<div class="col-sm-10">
						{!! form_input('tensi','','class="form-control"') !!}
					</div>
				</div>
				<div class="form-group">
					{!! form_label('Nadi','nadi','class="col-sm-2 control-label"') !!}
					<div class="col-sm-10">
						{!! form_input('nadi','','class="form-control"') !!}
					</div>
				</div>
				<div class="form-group">
					{!! form_label('Suhu','suhu','class="col-sm-2 control-label"') !!}
					<div class="col-sm-10">
						{!! form_input('suhu','','class="form-control"') !!}
					</div>
				</div>
				<div class="form-group">
					{!! form_label('Pernapasan','pernapasan','class="col-sm-2 control-label"') !!}
					<div class="col-sm-10">
						{!! form_input('pernapasan','','class="form-control"') !!}
					</div>
				</div>
				<div class="form-group">
					{!! form_label('Nyeri','nyeri','class="col-sm-2 control-label"') !!}
					<div class="col-sm-10">
						{!! form_dropdown('nyeri',array('Tidak nyeri'=>'Tidak nyeri', 'Nyeri ringan'=>'Nyeri ringan','Nyeri berat'=>'Nyeri berat'),'','class="form-control"') !!}
					</div>
				</div>
				<div class="form-group">
					{!! form_label('Keterangan Lain','keterangan_lain','class="col-sm-2 control-label"') !!}
					<div class="col-sm-10">
						{!! form_input('keterangan_lain','','class="form-control"') !!}
					</div>
				</div>
				<div class="form-group">
					{!! form_label('Hasil Lab','hasil_lab','class="col-sm-2 control-label"') !!}
					<div class="col-sm-10">
						{!! form_input('hasil_lab','','class="form-control"') !!}
					</div>
				</div>
				<div class="form-group">
					{!! form_label('Hasil Radiologi','hasil_radiologi_ekg','class="col-sm-2 control-label"') !!}
					<div class="col-sm-10">
						{!! form_input('hasil_radiologi_ekg','','class="form-control"') !!}
					</div>
				</div>
				<div class="form-group">
					{!! form_label('Tindakan','tindakan','class="col-sm-2 control-label"') !!}
					<div class="col-sm-10">
						{!! form_input('tindakan','','class="form-control"') !!}
					</div>
				</div>
				<div class="form-group">
					{!! form_label('Pembiayaan','pembiayaan','class="col-sm-2 control-label"') !!}
					<div class="col-sm-10">
						{!! form_dropdown('pembiayaan',$pembiayaan_select,'','class="form-control"') !!}
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
		<i class="fa fa-wrench bg-aqua"></i>
		<div class="timeline-item">
			<h3 class="timeline-header"><a href="javascript:void(0)">Aksi</a></h3>

			<div class="timeline-body">
				{!! form_submit('save','Simpan','class="btn btn-primary"') !!}
				{!! form_reset('reset','Reset','class="btn btn-warning"') !!}
				{!! anchor(base_url('panel/rujukan/rujuk'),'Back','class="btn btn-danger"') !!}
			</div>
		</div>
	</li>
	<li><i class="fa fa-send bg-maroon"></i></li>
</ul>