@extends('layouts.panel_layout')

@section('content')
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Form {{$page_desc}}</li>
    </ol>
    <h1 class="page-header f-s-14 f-w-500">Form {{$page_desc}}</h1>

		<div class="row">
	        <div class="col-lg-12">
	            <ul class="nav nav-tabs">
	                <li class="nav-items">
	                    <a href="#default-tab-1" data-toggle="tab" class="nav-link active show">
	                        <span class="d-sm-none">Tab 1</span>
	                        <span class="d-sm-block d-none">Rujukan <span class="label label-danger">COVID</span> <span class="label label-warning">Umum</span></span>
	                    </a>
	                </li>
	                <li class="nav-items">
	                    <a href="#default-tab-2" data-toggle="tab" class="nav-link">
	                        <span class="d-sm-none">Tab 2</span>
	                        <span class="d-sm-block d-none">Rujukan <span class="label label-danger">COVID</span> <span class="label label-info">Maternal Neonatal</span></span>
	                    </a>
	                </li>
	                <!--<li class="nav-items">
	                    <a href="#default-tab-3" data-toggle="tab" class="nav-link">
	                        <span class="d-sm-none">Tab 3</span>
	                        <span class="d-sm-block d-none">Konsultasi Ibu Hamil <span class="label label-warning">Cooming Soon</span></span>
	                    </a>
	                </li>-->
	            </ul>
	            <div class="tab-content p-5">
	                <div class="tab-pane fade active show" id="default-tab-1">
	                	{!! form_open_multipart() !!}
	                	<input type="hidden" name="type" value="1">
	                    <div class="panelruj3 panel-inverse" data-sortable-id="table-basic-5">
	                        <div class="panel-body">
	                            <form>
	                                <div class="row">
	                                    <div class="col-lg-6">
	                                        <h1 class="page-header f-s-16 f-w-500">Data Pasien</h1>
	                                        <hr class="m-t-0">
	                                        <div class="form-group row">
	                                            <label class="col-md-2 col-form-label">Data Pasien</label>
	                                            <div class="col-md-10">
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="pasien_type" id="pasien_type_old" value="old" />
	                                                    <label for="pasien_type_old">Pasien Lama</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="pasien_type" id="pasien_type_new" value="new" checked>
	                                                    <label for="pasien_type_new">Pasien Baru</label>
	                                                </div>
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                        	<label class="col-form-label col-md-2">Cari Pasien</label>
												<div class="col-sm-10">
													{!! form_dropdown('no_rm','','','class="form-control old_group select_pasien" required style="width: 100%"') !!}
												</div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Nama</label>
	                                            <div class="col-md-10">
	                                               {!! form_input('nama','','class="form-control form-control-sm new_group" id="kontak" placeholder="Nama Pasien"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Telpon/HP</label>
	                                            <div class="col-md-10">
	                                                {!! form_input('kontak','','class="form-control form-control-sm new_group" id="kontak" placeholder="Kontak Pasien"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Umur</label>
	                                              <div class="col-md-10">
	                                               {!! form_input('ibuanak_umur','','class="form-control form-control-sm new_group" id="kontak" placeholder="Umur"') !!}
	                                            </div>
	                                        </div>	                                        
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Tempat Lahir</label>
	                                            <div class="col-md-10">
	                                                {!! form_input('tempat_lahir','','class="form-control form-control-sm new_group" id="tempat_lahir" placeholder="Tempat Lahir"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label for="tgl_lahir" class="col-form-label col-md-2">Tanggal Lahir</label>
	                                            <!--<div class="col-md-10">-->
	                                            <div class="datepicker" style="width: 80px">
	                                                <!--{!! form_input('tgl_lahir','','class="form-control form-control-sm new_group" id="tgl_lahir" placeholder="Tanggal Lahir Pasien"') !!}-->
	                                                <input type="date" class="datepicker" name="tgl_lahir" id="date">
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Jenis kelamin</label>
	                                            <div class="col-md-10">
	                                                {!! form_dropdown('jenis_kelamin',array('Laki-laki'=>'Laki-laki', 'Perempuan'=>'Perempuan'),'','class="form-control form-control-sm new_group default-select2" id="jenis_kelamin" placeholder="Kontak Pasien" required style="width: 100%"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">NIK</label>
	                                            <div class="col-md-10">
	                                                {!! form_input('nik','','class="form-control form-control-sm new_group" id="nik" placeholder="NIK Pasien"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row m-b-15">
	                                            <label class="col-form-label col-md-2">Alamat</label>
	                                            <div class="col-md-10">
	                                                {!! form_textarea('alamat','','class="form-control form-control-sm new_group" id="alamat" placeholder="Alamat Pasien" style="height: 60px"') !!}
	                                            </div>
	                                        </div>
	                                        <h1 class="page-header f-s-16 f-w-500">Fasilitas Kesehatan</h1>
	                                        <hr class="m-t-0">
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-3">Nomor Perujuk</label>
	                                            <div class="col-md-9">
													<select class="form-control cb-telp-nakes" name="ibuanak_nobidan" style="width: 100%"></select>
	                                                {{-- form_input('ibuanak_nobidan','','class="form-control form-control-sm" id="kontak" required placeholder="Mulailah dengan 62, contoh 628112111828"') --}}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-3">Nama Perujuk</label>
	                                            <div class="col-md-9">
													<select class="form-control cb-nama-nakes" name="ibuanak_namabidan" style="width: 100%"></select>
	                                                 {{-- form_dropdown('ibuanak_namabidan',$namabidandokter,'','class="form-control default-select2" id="kontak" required style="width: 100%"') --}}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-3">Asal Faskes</label>
	                                            <div class="col-md-9">
	                                                {!! form_dropdown('id_rs_perujuk',$perujuk,'','class="form-control default-select2 rs_perujuk" id="id_rs_perujuk" required style="width: 100%"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Kelas Bed</label>
	                                            <div class="col-md-10">
	                                                {!! form_dropdown('id_kelas_bed',$kelas_bed_select,'','class="form-control default-select2" id="id_kelas_bed" required style="width: 100%"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">layanan RS</label>
	                                            <div class="col-md-10">
	                                                {!! form_dropdown('id_jenis_layanan',$layanan_select,'','class="form-control default-select2" id="id_jenis_layanan" required style="width: 100%"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Faskes Tujuan</label>
	                                            <div class="col-md-10">
	                                                {!! form_dropdown('id_rs_dirujuk',$dirujuk,'','class="form-control default-select2" id="id_rs_dirujuk" required style="width: 100%"') !!}
	                                            </div>
	                                        </div>

	                                        
	                                        <h1 class="page-header f-s-16 f-w-500"><b>Info Klinis</b></h1>
	                                        <hr class="m-t-0">
	                                        <div>
	                                            <label class="col-form-label col-md-2"><b>Traveling Zona Merah:</b></label>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media31" value="Ya" />
	                                                    <label for="media31"><b>Ya</b></label>
	                                            </div>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media32" value="Tidak" />
	                                                    <label for="media32"><b>Tidak</b></label>
	                                            </div>
	                                        </div>
	                                        <div>
	                                            <label class="col-form-label col-md-2"><b>Demam (>38 o):</b></label>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media33" value="Ya" />
	                                                    <label for="media33"><b>Ya</b></label>
	                                            </div>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media34" value="Tidak" />
	                                                    <label for="media34"><b>Tidak</b></label>
	                                            </div>
	                                        </div>	

	                                        <div>
	                                            <label class="col-form-label col-md-2"><b>Batuk:</b></label>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media35" value="Ya" />
	                                                    <label for="media35"><b>Ya</b></label>
	                                            </div>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media36" value="Tidak" />
	                                                    <label for="media36"><b>Tidak</b></label>
	                                            </div>
	                                        </div>	

	                                        <div>
	                                            <label class="col-form-label col-md-2"><b>Sputum:</b></label>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media37" value="Ya" />
	                                                    <label for="media37"><b>Ya</b></label>
	                                            </div>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media38" value="Tidak" />
	                                                    <label for="media38"><b>Tidak</b></label>
	                                            </div>
	                                        </div>	

	                                        <div>
	                                            <label class="col-form-label col-md-2"><b>Pilek:</b></label>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media39" value="Ya" />
	                                                    <label for="media39"><b>Ya</b></label>
	                                            </div>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media40" value="Tidak" />
	                                                    <label for="media40"><b>Tidak</b></label>
	                                            </div>
	                                        </div>	

	                                        <div>
	                                            <label class="col-form-label col-md-2"><b>Sakit Tenggorokan:</b></label>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media41" value="Ya" />
	                                                    <label for="media41"><b>Ya</b></label>
	                                            </div>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media42" value="Tidak" />
	                                                    <label for="media42"><b>Tidak</b></label>
	                                            </div>
	                                        </div>

	                                        <div>
	                                            <label class="col-form-label col-md-2"><b>Sesak Nafas:</b></label>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media52" value="Ya" />
	                                                    <label for="media52"><b>Ya</b></label>
	                                            </div>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media53" value="Tidak" />
	                                                    <label for="media53"><b>Tidak</b></label>
	                                            </div>
	                                        </div>
	                                   		<div>
				                            <hr class="m-t-0">
				                            <h1 class="page-header f-s-16 f-w-500"><b>COMORBID</b></h1>	                                       
	                                    	<div class="col-form-label col-md-6">
	                                        <hr class="m-t-0">
	                                            <div class="col-md-10 f-w-500">
 	                                            <form method="post" action="">
												<input type="checkbox" id="checkItem" name="check[]" value="1">Diabetes Melitus<br>
												<input type="checkbox" id="checkItem" name="check[]" value="2">Hipertensi<br>
												<input type="checkbox" id="checkItem" name="check[]" value="3">Jantung Koroner<br>
												<input type="checkbox" id="checkItem" name="check[]" value="4">Paru<br>
												<input type="checkbox" id="checkItem" name="check[]" value="5">Hati/Liver<br>
												<input type="checkbox" id="checkItem" name="check[]" value="6">Ginjal<br>
												<input type="checkbox" id="checkItem" name="check[]" value="7">HIV/AIDS<br>
												<input type="checkbox" id="checkItem" name="check[]" value="8">Stroke<br>
												<input type="checkbox" id="checkItem" name="check[]" value="9">Lainnya<br>												
												</form>
                                               </div>
	                                        </div>
	                                    	</div> 	
	                                    </div>
 
	                                    <div class="col-lg-6">
	                                        <h1 class="page-header f-s-16 f-w-500">Resume Pasien</h1>
	                                        <hr class="m-t-0">
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Transportasi</label>
	                                            <div class="col-md-3">
	                                            	{!! form_dropdown('jenis_transport',array(1 => 'Ambulance',2 => 'Non-Ambulance'),null,'class="form-control default-select2 pilih-transport" required style="width: 100%"') !!}
	                                            </div>
	                                            <div class="col-md-7 cb-ambulance">
	                                                {!! form_dropdown('id_ambulance',$ambulance,null,'class="form-control default-select2"  style="width: 100%"') !!}
	                                            </div>
	                                            <div class="col-md-7 cb-manual" style="display: none">
	                                                {!! form_input('transportasi','','class="form-control"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Alasan Rujukan</label>
	                                            <div class="col-md-10">
	                                                {!! form_input('alasan_rujukan','','class="form-control" placeholder="Jika COVID, tulis alasan perawatan yg diperlukan, misal: Ventilator, SpPD, Sp Paru, Perlu Ruang ISOLASI COVID"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Diagnosa</label>
	                                            <div class="col-md-10">
	                                               {!! form_textarea('diagnosis','','class="form-control" style="height: 80px" placeholder="Jika COVID, tambahkan info status COVID, misal: PDP COVID, Confirmed + COVID. PILIH KELAS BED: ISOLASI COVID, LAYANAN RS: ISOLASI COVID "') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">ICD X</label>
	                                            <div class="col-md-10">
	                                                <select name="ibuanak_icdx" class="cb-icdx form-control form-control-sm" style="width: 100%"></select>
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Kesadaran</label>
	                                            <div class="col-md-10">
	                                                {!! form_dropdown('kesadaran',array(
														'Composmentis' => 'Composmentis', 
														'Apatis' => 'Apatis',   
														'Delirium' => 'Delirium', 
														'Somnolen' => 'Somnolen',
														'Sopor' => 'Sopor', 
														'Semi-coma' => 'Semi-coma',
														'Coma' => 'Coma'),'','class="form-control default-select2" required style="width: 40%"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Tensi</label>
	                                            <div class="col-md-10">
	                                                {!! form_input('tensi','','class="form-control"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Nadi</label>
	                                            <div class="col-md-10">
	                                                {!! form_input('nadi','','class="form-control"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Suhu</label>
	                                            <div class="col-md-10">
	                                                {!! form_input('suhu','','class="form-control"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Pernapasan</label>
	                                            <div class="col-md-10">
	                                                {!! form_input('pernapasan','','class="form-control"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">GCS</label>
	                                            <div class="col-md-10">
													{!! form_dropdown('nyeri',array('1'=>'1', '2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15'),'','class="form-control default-select2" required style="width: 40%"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Keterangan Lain</label>
	                                            <div class="col-md-10">
	                                                {!! form_input('keterangan_lain','','class="form-control"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Hasil Lab</label>
	                                            <div class="col-md-10">
	                                                {!! form_input('hasil_lab','','class="form-control"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Pemeriksaan Penunjang</label>
	                                            <div class="col-md-10">
	                                                {!! form_input('hasil_radiologi_ekg','','class="form-control"') !!}
	                                            </div>
	                                        </div>  
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Tindakan Pra Rujukan</label>
	                                            <div class="col-md-10">
	                                                {!! form_input('tindakan','','class="form-control"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Pembiayaan</label>
	                                            <div class="col-md-10">
	                                                {!! form_dropdown('pembiayaan',$pembiayaan_select,'','class="form-control default-select2" required style="width: 100%"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Ambulan / Transportasi</label>
	                                            <div class="col-md-10">
	                                                {!! form_dropdown('transportasi',$transportasi_select,'','class="form-control default-select2" style="width: 40%') !!}
	                                            </div>
	                                        </div>  
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Lampiran 1</label>
	                                            <div class="col-md-10">
	                                                {!! form_upload('attachment_1','','id="attachment_1"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Lampiran 2</label>
	                                            <div class="col-md-10">
	                                                {!! form_upload('attachment_2','','id="attachment_2"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Lampiran 3</label>
	                                            <div class="col-md-10">
	                                                {!! form_upload('attachment_3','','id="attachment_3"') !!}<br>
	                                                <small class="f-s-10 text-grey-darker">File maksimal 2MB dengan format yang diizinkan gif,jpg,png,docx,doc,xls,xlsx, atau pdf</small>
	                                            </div>
	                                        </div>
	                                    </div>  
	                                </div>
	                                <hr class="m-t-0">
	                                <div class="form-group row text-right">
	                                    <div class="col-md-12">
	                                        {!! form_submit('save','Simpan','class="btn btn-primary btn-sm"') !!}
											{!! form_reset('reset','Reset','class="btn btn-warning btn-sm"') !!}
											{!! anchor(base_url('panel/data_rujukan'),'Back','class="btn btn-danger btn-sm"') !!}
	                                    </div>
	                                </div>
	                            </form>
	                        </div>            
	                    </div>
	                    {!! form_close() !!}
	                </div>
	                
	                <div class="tab-pane fade" id="default-tab-2">
	                	{!! form_open_multipart() !!}
	                	<input type="hidden" name="type" value="2">
	                	<input type="hidden" name="jenis_kelamin" value="Perempuan" value="2">
	                    <div class="panelruj4 panel-inverse" data-sortable-id="table-basic-5">
	                        <div class="panel-body">
	                            <form>
	                                <div class="row">
	                                    <div class="col-lg-6">
	                                        <h1 class="page-header f-s-16 f-w-500">Data Pasien</h1>
	                                        <hr class="m-t-0">
	                                        <div class="form-group row">
	                                            <label class="col-md-2 col-form-label">STATUS MAT-NEO</label>
	                                            <div class="col-md-10">
	                                                <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media18" value="Tanpa CC" />
	                                                    <label for="media18"><b>Hamil Tanpa Faktor Risiko</b></label>
	                                                </div>                                           	
	                                                <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media11" value="Telpon CC" />
	                                                    <label for="media11">Hamil Dengan Faktor Risiko</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media12" value="Dispatch NCC" />
	                                                    <label for="media12">Pasca Salin tanpa Komplikasi</label>
	                                                </div>		                                                
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media13" value="SMS" checked>
	                                                    <label for="media13">Pasca Salin dgn Komplikasi</label>
	                                                </div>                                                
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media14" value="Whatsapp" />
	                                                    <label for="media14">Newborn Normal</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media15" value="Web" />
	                                                    <label for="media15">Newborn Komplikasi</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media16" value="Android" />
	                                                    <label for="media16">Bayi Normal</label>
	                                                </div>		                                                	 	      
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media17" value="Lainnya" />
	                                                    <label for="media17">Bayi Komplikasi</label>
	                                                </div>	                                                
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-md-2 col-form-label">Status Pasien</label>
	                                            <div class="col-md-10">
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="pasien_type" id="pasien_type_old2" value="old" />
	                                                    <label for="pasien_type_old2">Pasien Lama</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="pasien_type" id="pasien_type_new2" value="new" checked>
	                                                    <label for="pasien_type_new2">Pasien Baru</label>
	                                                </div>
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Cari Pasien</label>
												<div class="col-sm-10">
													{!! form_dropdown('no_rm','','','class="form-control old_group select_pasien" style="width: 100%"') !!}
												</div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Nama Ibu</label>
	                                             <div class="col-md-10">
	                                           		{!! form_input('nama','','class="form-control form-control-sm new_group" id="kontak" placeholder="Nama Pasien"') !!}
	                                        	</div>
	                                        </div>
	                                          <div class="form-group row">
	                                            <label class="col-form-label col-md-2">NIK Ibu</label>
	                                            <div class="col-md-10">
	                                                {!! form_input('nik','','class="form-control form-control-sm new_group" id="nik" placeholder="NIK Pasien"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Umur</label>
	                                              <div class="col-md-10">
	                                               {!! form_input('ibuanak_umur','','class="form-control form-control-sm new_group" id="kontak" placeholder="Umur"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Nama Suami/ Pananggung Jwb</label>
	                                            <div class="col-md-10">
	                                               {!! form_input('ibuanak_namasuami','','class="form-control form-control-sm new_group" id="kontak" placeholder="Nama Suami"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Golongan Darah</label>
	                                            <div class="col-md-10">
	                                                <select class="form-control form-control-sm default-select2 new_group"  style="width: 100%" name="ibuanak_goldarah">
	                                                    <option>Pilih Golongan Darah</option>
	                                                    <option value="A">A</option>
	                                                    <option value="AB">AB</option>
	                                                    <option value="B">B</option>
	                                                    <option value="O">O</option>
	                                                    <option value="-">Belum Diketahui</option>	                                                    
	                                                </select>
	                                            </div>
	                                        </div>
	                                        <h1 class="page-header f-s-16 f-w-500">Data Perujuk</h1>
	                                        <hr class="m-t-0">
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-3">Nomor Perujuk</label>
	                                            <div class="col-md-9">
													<select class="form-control cb-telp-bidan" name="ibuanak_nobidan" style="width: 100%"></select>
	                                                {{-- form_input('ibuanak_nobidan','','class="form-control form-control-sm" id="kontak" required placeholder="Mulailah dengan 62, contoh 628112111828"') --}}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-3">Nama Perujuk</label>
	                                            <div class="col-md-9">
													<select class="form-control cb-nama-bidan" name="ibuanak_namabidan" style="width: 100%"></select>
	                                                {{-- form_dropdown('ibuanak_namabidan',$namabidandokter,'','class="form-control default-select2" id="kontak" required style="width: 100%"') --}}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-3">Asal Faskes</label>
	                                            <div class="col-md-9">
	                                                {!! form_dropdown('id_rs_perujuk',$perujuk,'','class="form-control default-select2 ibuanak_faskes" id="id_rs_perujuk" required style="width: 100%"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-3">Status Swasta / Negeri</label>
	                                            <div class="col-md-9">
	                                                <select class="form-control form-control-sm default-select2" name="ibuanak_kodebidan" style="width: 100%">
	                                                    <option>Pilih Status Faskes</option>
	                                                    <option value="1">Negeri/Pemerintah</option>
	                                                    <option value="2">Swasta/Pribadi</option>
	                                                </select>
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Asal Faskes</label>
	                                            <div class="col-md-10">
	                                                {!! form_dropdown('id_rs_perujuk',$perujuk,'','class="form-control default-select2" id="id_rs_perujuk" required style="width: 100%"') !!}
	                                            </div>
	                                        </div>
	                                        <h1 class="page-header f-s-16 f-w-500">Fasilitas Kesehatan</h1>
	                                        <hr class="m-t-0">
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Kelas Bed</label>
	                                            <div class="col-md-10">
	                                                {!! form_dropdown('id_kelas_bed',$kelas_bed_select,'','class="form-control default-select2" id="id_kelas_bed" required style="width: 100%"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">layanan RS</label>
	                                            <div class="col-md-10">
	                                                {!! form_dropdown('id_jenis_layanan',$layanan_select,'','class="form-control default-select2" id="id_jenis_layanan" required style="width: 100%"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Faskes Tujuan</label>
	                                            <div class="col-md-10">
	                                                {!! form_dropdown('id_rs_dirujuk',$dirujuk,'','class="form-control default-select2" id="id_rs_dirujuk" required style="width: 100%"') !!}
	                                            </div>
	                                        </div>  
	                                    </div>


	                                    <div class="col-lg-6">
	                                        <h1 class="page-header f-s-16 f-w-500"><b>Info Klinis</b></h1>
	                                        <hr class="m-t-0">

	                                        <div>
	                                            <label class="col-form-label col-md-2"><b>Traveling Zona Merah:</b></label>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media61" value="Ya" />
	                                                    <label for="media61"><b>Ya</b></label>
	                                            </div>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media62" value="Tidak" />
	                                                    <label for="media62"><b>Tidak</b></label>
	                                            </div>
	                                        </div>
	                                        <div>
	                                            <label class="col-form-label col-md-2"><b>Demam (>38 o):</b></label>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media63" value="Ya" />
	                                                    <label for="media63"><b>Ya</b></label>
	                                            </div>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media64" value="Tidak" />
	                                                    <label for="media64"><b>Tidak</b></label>
	                                            </div>
	                                        </div>	

	                                        <div>
	                                            <label class="col-form-label col-md-2"><b>Batuk:</b></label>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media65" value="Ya" />
	                                                    <label for="media65"><b>Ya</b></label>
	                                            </div>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media66" value="Tidak" />
	                                                    <label for="media66"><b>Tidak</b></label>
	                                            </div>
	                                        </div>	

	                                        <div>
	                                            <label class="col-form-label col-md-2"><b>Sputum:</b></label>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media67" value="Ya" />
	                                                    <label for="media67"><b>Ya</b></label>
	                                            </div>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media68" value="Tidak" />
	                                                    <label for="media68"><b>Tidak</b></label>
	                                            </div>
	                                        </div>	

	                                        <div>
	                                            <label class="col-form-label col-md-2"><b>Pilek:</b></label>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media69" value="Ya" />
	                                                    <label for="media69"><b>Ya</b></label>
	                                            </div>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media70" value="Tidak" />
	                                                    <label for="media70"><b>Tidak</b></label>
	                                            </div>
	                                        </div>	

	                                        <div>
	                                            <label class="col-form-label col-md-2"><b>Sakit Tenggorokan:</b></label>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media71" value="Ya" />
	                                                    <label for="media71"><b>Ya</b></label>
	                                            </div>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media72" value="Tidak" />
	                                                    <label for="media72"><b>Tidak</b></label>
	                                            </div>
	                                        </div>

	                                        <div>
	                                            <label class="col-form-label col-md-2"><b>Sesak Nafas:</b></label>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media73" value="Ya" />
	                                                    <label for="media73"><b>Ya</b></label>
	                                            </div>
	                                            <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media74" value="Tidak" />
	                                                    <label for="media374"><b>Tidak</b></label>
	                                            </div>
	                                            <div><br></div>
	                                        </div>

	                                        <h1 class="page-header f-s-16 f-w-500"><b>Diagnosa</b></h1>
	                                        <hr class="m-t-0">
	                                        <div class="form-group row m-b-15">
	                                            <label class="col-form-label col-md-2">Diagnosa</label>
	                                            <div class="col-md-10">
	                                                 {!! form_textarea('diagnosis','','class="form-control" style="height: 80px" placeholder="Jika COVID, tambahkan info status COVID, misal: PDP COVID, Confirmed + COVID. PILIH KELAS BED: ISOLASI COVID, LAYANAN RS: ISOLASI COVID "') !!}
	                                                 
	                                                <small>Ibu Diagnosa: GPA, UK, PK (PK1,2,3), Komplikasi, DJJ, Posisi Bayi, Jml Janin, Faktor Penyulit Vital Sign: TD, Suhu,Nadi, Respirasi. 
	                                                Bayi Diagnosa: GPA, Usia Gestasi, Komplikasi , Cara lahir, Apgar score, warna ketuban, BB,PB, LL,LK, Usia Bayi, Vital Sign: TD, Suhu,Nadi, Respirasi</small>
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">ICD X</label>
	                                            <div class="col-md-10">
	                                                <select name="ibuanak_icdx" class="cb-icdx form-control form-control-sm" style="width: 100%"></select>
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Pemeriksaan Penunjang</label>
	                                            <div class="col-md-10">
	                                                 {!! form_input('alasan_rujukan','','class="form-control"') !!}
	                                                <small>pemeriksaan hiv, hbsag, cek protein urin, tespek, usg</small>
	                                            </div>
	                                        </div>
	                                        <div class="form-group row m-b-15">
	                                            <label class="col-form-label col-md-2">Tindakan Pra Rujukan</label>
	                                            <div class="col-md-10">
	                                                {!! form_input('tindakan','','class="form-control form-control-sm" id="tindakan" placeholder="Tata Laksana Pra Rujukan/Stabilisasi"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Asuransi</label>
	                                            <div class="col-md-10">
	                                                {!! form_dropdown('pembiayaan',$pembiayaan_select,'','class="form-control default-select2" style="width: 100%') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Ambulan / Transportasi</label>
	                                            <div class="col-md-10">
	                                                {!! form_dropdown('transportasi',$transportasi_select,'','class="form-control default-select2" style="width: 100%') !!}
	                                            </div>
	                                        </div>  
	                                    </div>  
	                                </div>
	                                <hr class="m-t-0">
	                                <div class="form-group row text-right">
	                                    <div class="col-md-12">
	                                        {!! form_submit('save','Simpan','class="btn btn-primary btn-sm"') !!}
											{!! form_reset('reset','Reset','class="btn btn-warning btn-sm"') !!}
											{!! anchor(base_url('panel/data_rujukan'),'Back','class="btn btn-danger btn-sm"') !!}
	                                    </div>
	                                </div>
	                            </form>
	                        </div>            
	                    </div>
	                    {!! form_close() !!}
	                </div>
	               	<div class="tab-pane fade" id="default-tab-3">
	                    <div class="panelruj panel-inverse" data-sortable-id="table-basic-5">
	                        <div class="panel-body">
	                            <form>
	                            	<p>Cooming soon .....</p>
	                            </form>
	                        </div>            
	                    </div>
	                </div>
	            </div>
	        </div> 
	    </div> 	

</div>
@endsection

@section('script')
	@include('partials.toastr_msg')
	<!-- InputMask -->
	<script src="{{load_asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
	<script src="{{load_asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
	<script src="{{load_asset('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
	<script src="{{load_asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
	<script src="{{load_asset('bower_components/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>	
	<script type="text/javascript">
		$(function(){

			$('.pilih-transport').change(function() {
				if ($(this).val() == "1") 
				{	
					$('.cb-ambulance').show();
					$('.cb-manual').hide();
				} else {
					$('.cb-ambulance').hide();
					$('.cb-manual').show();
				}
			});

			$('input[type=radio][name=pasien_type]').change(function() {
				refresh_form(this.value);
			});
			$('.select_pasien').select2({
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

			$('.cb-icdx').select2({
				placeholder: 'Kode ICD X, KODE DIAGNOSA, WAJIB DIISI',
				minimumInputLength:1,
				ajax: {
					url: "{{base_url('panel/rujukan/icdx_list')}}",
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
			refresh_rs_select();
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
		
		$('.cb-telp-nakes').select2({
			placeholder: 'Nomor Telp Perujuk',
			minimumInputLength:1,
			ajax: {
				url: "{{base_url('panel/rujukan/find_nakes?type=telp')}}",
				dataType: 'json', delay: 250,
				data: function(params){
					return { q: params.term }
				},
				processResults: function(data, params){
					var output=[];
					data.forEach(function(val,index){
						output.push({
							id: val.telp, nama: val.nama, text: val.telp, id_rs: val.id_rs
						});
					});
					return { results:output };
					}, cache: true
			}
		}).on('select2:select', function (e) {
				$('.cb-nama-nakes').append('<option value="'+e.params.data.nama+'" selected>'+e.params.data.nama+'</option>').trigger('change')
				$('.rs_perujuk').val(e.params.data.id_rs).trigger('change')
		});

		$('.cb-nama-nakes').select2({
			placeholder: 'Nama Perujuk',
			minimumInputLength:1,
			ajax: {
				url: "{{base_url('panel/rujukan/find_nakes?type=nama')}}",
				dataType: 'json', delay: 250,
				data: function(params){
					return { q: params.term }
				},
				processResults: function(data, params){
					var output=[];
					data.forEach(function(val,index){
						output.push({
							id: val.nama, telp: val.telp, text: val.nama, id_rs: val.id_rs
						});
					});
					return { results:output };
					}, cache: true
			}
		}).on('select2:select', function (e) {
			$('.cb-telp-nakes').append('<option value="'+e.params.data.telp+'" selected>'+e.params.data.telp+'</option>').trigger('change')
			$('.rs_perujuk').val(e.params.data.id_rs).trigger('change')
		});

		$('.cb-telp-bidan').select2({
		  placeholder: 'Nomor Telp Perujuk',
		  minimumInputLength:1,
		  ajax: {
		    url: "{{base_url('panel/rujukan/find_nakes?type=telp')}}",
		    dataType: 'json', delay: 250,
		    data: function(params){
		      return { q: params.term }
		    },
		    processResults: function(data, params){
		      var output=[];
		      data.forEach(function(val,index){
		        output.push({
		          id: val.telp, nama: val.nama, text: val.telp, id_rs: val.id_rs
		        });
		      });
		      return { results:output };
		      }, cache: true
		  }
		}).on('select2:select', function (e) {
		    $('.cb-nama-bidan').append('<option value="'+e.params.data.nama+'" selected>'+e.params.data.nama+'</option>').trigger('change')
		    $('.ibuanak_faskes').val(e.params.data.id_rs).trigger('change')
		});

		$('.cb-nama-bidan').select2({
		  placeholder: 'Nama Perujuk',
		  minimumInputLength:1,
		  ajax: {
		    url: "{{base_url('panel/rujukan/find_nakes?type=nama')}}",
		    dataType: 'json', delay: 250,
		    data: function(params){
		      return { q: params.term }
		    },
		    processResults: function(data, params){
		      var output=[];
		      data.forEach(function(val,index){
		        output.push({
		          id: val.nama, telp: val.telp, text: val.nama, id_rs: val.id_rs
		        });
		      });
		      return { results:output };
		      }, cache: true
		  }
		}).on('select2:select', function (e) {
		  $('.cb-telp-bidan').append('<option value="'+e.params.data.telp+'" selected>'+e.params.data.telp+'</option>').trigger('change')
		  $('.ibuanak_faskes').val(e.params.data.id_rs).trigger('change')
		});
		
	</script>
@endsection

@section('head')
	<link rel="stylesheet" href="{{load_asset('bower_components/select2/dist/css/select2.min.css')}}">
@endsection
