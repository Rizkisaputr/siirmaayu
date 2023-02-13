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
	                        <span class="d-sm-block d-none">Rujukan Umum <span class="label label-danger">Gawat Darurat</span></span>
	                    </a>
	                </li>
	                <li class="nav-items">
	                    <a href="#default-tab-2" data-toggle="tab" class="nav-link">
	                        <span class="d-sm-none">Tab 2</span>
	                        <span class="d-sm-block d-none">Rujukan Maternal (Obstetri) <span class="label label-warning"> MATERNAL (Obstetri)</span></span>
	                    </a>
	                </li>
	                <li class="nav-items">
	                    <a href="#default-tab-3" data-toggle="tab" class="nav-link">
	                        <span class="d-sm-none">Tab 3</span>
	                        <span class="d-sm-block d-none">Rujukan Gynechology <span class="label label-purple"> GYNECHOLOGY</span></span>
	                    </a>
	                </li>
	                <li class="nav-items">
	                    <a href="#default-tab-4" data-toggle="tab" class="nav-link">
	                        <span class="d-sm-none">Tab 4</span>
	                        <span class="d-sm-block d-none">Rujukan Neonatal <span class="label label-success"> NEONATAL</span></span>
	                    </a>
	                </li>
	                <li class="nav-items">
	                    <a href="#default-tab-5" data-toggle="tab" class="nav-link">
	                        <span class="d-sm-none">Tab 5</span>
	                        <span class="d-sm-block d-none">Rujukan Bayi Balita / Anak <span class="label label-info"> BAYI BALITA ANAK</span></span>
	                    </a>
	                </li>	                
	                <li class="nav-items">
	                    <a href="#default-tab-6" data-toggle="tab" class="nav-link">
	                        <span class="d-sm-none">Tab 6</span>
	                        <span class="d-sm-block d-none ">Konsultasi <span class="label label-primary">  KONSULTASI</span></span>
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
	                    <div class="panelruj2 panel-inverse" data-sortable-id="table-basic-5">
	                        <div class="panel-body">
	                            <form>
	                                <div class="row">
	                                    <div class="col-lg-6">
	                                        <h1 class="page-header f-s-16 f-w-500">Data Pasien Non-MatNeo</h1>
	                                        <hr class="m-t-0">
	                                        <div class="form-group row">
	                                            <label class="col-md-2 col-form-label">Media Rujukan</label>
	                                            <div class="col-md-10">
	                                                <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media8" value="Tanpa CC" />
	                                                    <label for="media8"><b>TIDAK melalui CC</b></label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media1" value="Telpon CC" />
	                                                    <label for="media1">CC PSC</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media2" value="Dispatch NCC" />
	                                                    <label for="media2">dari NCC</label>
	                                                </div>		                                                
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media3" value="SMS" />
	                                                    <label for="media3">SMS</label>
	                                                </div>                                                
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media4" value="Whatsapp" />
	                                                    <label for="media4">Whatsapp</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media5" value="Whatsapp Gateway " checked>
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
	                                               {!! form_input('nama','','class="form-control form-control-sm new_group" id="kontak" required placeholder="Nama Pasien"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Telpon/HP</label>
	                                            <div class="col-md-10">
	                                                {!! form_input('kontak','','class="form-control form-control-sm new_group" id="kontak" required placeholder="Kontak Pasien"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Umur</label>
	                                              <div class="col-md-10">
	                                               {!! form_input('ibuanak_umur','','class="form-control form-control-sm new_group" id="kontak" required placeholder="Umur"') !!}
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
	                                                {!! form_textarea('diagnosis','','class="form-control" required style="height: 80px" placeholder="Jika COVID, tambah info status COVID & COMORBID, misal: PDP COVID, Confirmed + COVID & DM. PILIH KELAS BED: ISOLASI COVID, LAYANAN RS: ISOLASI COVID "') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">ICD X</label>
	                                            <div class="col-md-10">
	                                                <select name="ibuanak_icdx" class="cb-icdx form-control form-control-sm" required style="width: 100%"></select>
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
	                                                {!! form_dropdown('transportasi',$transportasi_select,'','class="form-control default-select2" required style="width: 40%') !!}
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
	                    <div class="panelruj1 panel-inverse" data-sortable-id="table-basic-5">
	                        <div class="panel-body">
	                            <form>
	                                <div class="row">
	                                    <div class="col-lg-6">
	                                        <h1 class="page-header f-s-16 f-w-500">Data Pasien Maternal (Obstetri)</h1>
	                                        <hr class="m-t-0">
	                                        <div class="form-group row">
	                                            <label class="col-md-2 col-form-label">Media Rujukan</label>
	                                            <div class="col-md-10">
	                                                <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media18" value="Tanpa CC" />
	                                                    <label for="media18"><b>TIDAK melalui CC</b></label>
	                                                </div>                                           	
	                                                <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media11" value="Telpon CC" />
	                                                    <label for="media11">CC PSC</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media12" value="Dispatch NCC" />
	                                                    <label for="media12">dari NCC</label>
	                                                </div>		                                                
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media13" value="SMS" />
	                                                    <label for="media13">SMS</label>
	                                                </div>                                                
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media9" value="Whatsapp" />
	                                                    <label for="media9">Whatsapp</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media10" value="Whatsapp Gateway" checked>
	                                                    <label for="media10">Whatsapp Gateway</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media14" value="Web" />
	                                                    <label for="media14">Web</label>
	                                                </div>   	                                                	 	      
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media17" value="Lainnya" />
	                                                    <label for="media17">Lainnya</label>
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
	                                           		{!! form_input('nama','','class="form-control form-control-sm new_group" id="kontak" required placeholder="Nama Pasien"') !!}
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
	                                               {!! form_input('ibuanak_umur','','class="form-control form-control-sm new_group" id="kontak" required placeholder="Umur"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Nama Suami/ Pananggung Jwb</label>
	                                            <div class="col-md-10">
	                                               {!! form_input('ibuanak_namasuami','','class="form-control form-control-sm new_group" id="kontak" required placeholder="Nama Suami"') !!}
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
	                                                <select class="form-control form-control-sm default-select2" name="ibuanak_kodebidan" required style="width: 100%">
	                                                    <option>Pilih Status Faskes</option>
	                                                    <option value="1">Negeri/Pemerintah</option>
	                                                    <option value="2">Swasta/Pribadi</option>
	                                                </select>
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
	                                        <h1 class="page-header f-s-16 f-w-500">Diagnosa</h1> 
	                                        <hr class="m-t-0">
	                                        <div class="form-group row m-b-15">
	                                            <label class="col-form-label col-md-2">Diagnosa</label>
	                                            <div class="col-md-10">
	                                                 {!! form_textarea('diagnosis','','class="form-control" required style="height: 80px" placeholder="Jika COVID, tambah info status COVID & COMORBID, misal: PDP COVID, Confirmed + COVID & DM. PILIH KELAS BED: ISOLASI COVID, LAYANAN RS: ISOLASI COVID "') !!}
	                                                <small>Maternal Diagnosa: GPA, UK, PK (PK1,2,3), Komplikasi, DJJ, Posisi Bayi, Jml Janin, Faktor Penyulit Vital Sign: TD, Suhu,Nadi, Respirasi.</small>
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">ICD X</label>
	                                            <div class="col-md-10">
	                                                <select name="ibuanak_icdx" class="cb-icdx form-control form-control-sm" required style="width: 100%"></select>
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Pemeriksaan Penunjang</label>
	                                            <div class="col-md-10">
	                                                {!! form_input('alasan_rujukan','','class="form-control" placeholder="Jika COVID, tulis alasan perawatan yg diperlukan, misal: Ventilator, SpPD, Sp Paru, Perlu Ruang ISOLASI COVID"') !!}
	                                                <small>pemeriksaan hiv, hbsag, cek protein urin, tespek, usg</small>
	                                            </div>
	                                        </div>
	                                        <div class="form-group row m-b-15">
	                                            <label class="col-form-label col-md-2">Tindakan Pra Rujukan</label>
	                                            <div class="col-md-10">
	                                                {!! form_input('tindakan','','class="form-control form-control-sm" id="tindakan" required placeholder="Tata Laksana Pra Rujukan/Stabilisasi"') !!}
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
	                	{!! form_open_multipart() !!}
	                	<input type="hidden" name="type" value="3">
	                	<input type="hidden" name="jenis_kelamin" value="" value="2">
	                    <div class="panelruj1 panel-inverse" data-sortable-id="table-basic-5">
	                        <div class="panel-body">
	                            <form>
	                                <div class="row">
	                                    <div class="col-lg-6">
	                                        <h1 class="page-header f-s-16 f-w-500">Data Pasien Gynekologi)</h1>
	                                        <hr class="m-t-0">
	                                        <div class="form-group row">
	                                            <label class="col-md-2 col-form-label">Media Rujukan</label>
	                                            <div class="col-md-10">
	                                                <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media26" value="Tanpa CC" />
	                                                    <label for="media26"><b>TIDAK melalui CC</b></label>
	                                                </div>                                           	
	                                                <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media19" value="Telpon CC" />
	                                                    <label for="media19">CC PSC</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media20" value="Dispatch NCC" />
	                                                    <label for="media20">dari NCC</label>
	                                                </div>		                                                
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media21" value="SMS" />
	                                                    <label for="media21">SMS</label>
	                                                </div>                                                
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media22" value="Whatsapp" />
	                                                    <label for="media22">Whatsapp</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media23" value="Whatsapp Gateway" checked>
	                                                    <label for="media23">Whatsapp Gateway</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media24" value="Web" />
	                                                    <label for="media24">Web</label>
	                                                </div>   	                                                	 	      
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media25" value="Lainnya" />
	                                                    <label for="media25">Lainnya</label>
	                                                </div>	                                                
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-md-2 col-form-label">Status Pasien</label>
	                                            <div class="col-md-10">
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="pasien_type" id="pasien_type_old3" value="old" />
	                                                    <label for="pasien_type_old3">Pasien Lama</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="pasien_type" id="pasien_type_new3" value="new" checked>
	                                                    <label for="pasien_type_new3">Pasien Baru</label>
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
	                                           		{!! form_input('nama','','class="form-control form-control-sm new_group" id="kontak" required placeholder="Nama Pasien"') !!}
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
	                                               {!! form_input('ibuanak_umur','','class="form-control form-control-sm new_group" id="kontak" required placeholder="Umur"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Nama Suami/ Pananggung Jwb</label>
	                                            <div class="col-md-10">
	                                               {!! form_input('ibuanak_namasuami','','class="form-control form-control-sm new_group" id="kontak" required placeholder="Nama Suami"') !!}
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
	                                                <select class="form-control form-control-sm default-select2" name="ibuanak_kodebidan" required style="width: 100%">
	                                                    <option>Pilih Status Faskes</option>
	                                                    <option value="1">Negeri/Pemerintah</option>
	                                                    <option value="2">Swasta/Pribadi</option>
	                                                </select>
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
	                                        <h1 class="page-header f-s-16 f-w-500">Diagnosa</h1> 
	                                        <hr class="m-t-0">
	                                        <div class="form-group row m-b-15">
	                                            <label class="col-form-label col-md-2">Diagnosa</label>
	                                            <div class="col-md-10">
	                                                 {!! form_textarea('diagnosis','','class="form-control" required style="height: 80px" placeholder="Jika COVID, tambah info status COVID & COMORBID, misal: PDP COVID, Confirmed + COVID & DM. PILIH KELAS BED: ISOLASI COVID, LAYANAN RS: ISOLASI COVID "') !!}
	                                                <small>Gynek Diagnosa: Diagnosa, UK, PK (PK1,2,3), Komplikasi, Vital Sign: TD, Suhu,Nadi, Respirasi.</small>
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">ICD X</label>
	                                            <div class="col-md-10">
	                                                <select name="ibuanak_icdx" class="cb-icdx form-control form-control-sm" required style="width: 100%"></select>
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Pemeriksaan Penunjang</label>
	                                            <div class="col-md-10">
	                                                {!! form_input('alasan_rujukan','','class="form-control" placeholder="Jika COVID, tulis alasan perawatan yg diperlukan, misal: Ventilator, SpPD, Sp Paru, Perlu Ruang ISOLASI COVID"') !!}
	                                                <small>pemeriksaan hiv, hbsag, cek protein urin, tespek, usg</small>
	                                            </div>
	                                        </div>
	                                        <div class="form-group row m-b-15">
	                                            <label class="col-form-label col-md-2">Tindakan Pra Rujukan</label>
	                                            <div class="col-md-10">
	                                                {!! form_input('tindakan','','class="form-control form-control-sm" id="tindakan" required placeholder="Tata Laksana Pra Rujukan/Stabilisasi"') !!}
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
	                
	                <div class="tab-pane fade" id="default-tab-4">
	                	{!! form_open_multipart() !!}
	                	<input type="hidden" name="type" value="4">
	                	<input type="hidden" name="jenis_kelamin" value="" value="0">
	                    <div class="panelruj1 panel-inverse" data-sortable-id="table-basic-5">
	                        <div class="panel-body">
	                            <form>
	                                <div class="row">
	                                    <div class="col-lg-6">
	                                        <h1 class="page-header f-s-16 f-w-500">Data Pasien Neonatal</h1>
	                                        <hr class="m-t-0">
	                                        <div class="form-group row">
	                                            <label class="col-md-2 col-form-label">Media Rujukan</label>
	                                            <div class="col-md-10">
	                                                <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media34" value="Tanpa CC" />
	                                                    <label for="media34"><b>TIDAK melalui CC</b></label>
	                                                </div>                                           	
	                                                <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media27" value="Telpon CC" />
	                                                    <label for="media27">CC PSC</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media28" value="Dispatch NCC" />
	                                                    <label for="media28">dari NCC</label>
	                                                </div>		                                                
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media29" value="SMS" />
	                                                    <label for="media29">SMS</label>
	                                                </div>                                                
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media30" value="Whatsapp" />
	                                                    <label for="media30">Whatsapp</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media31" value="Whatsapp Gateway" checked>
	                                                    <label for="media31">Whatsapp Gateway</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media32" value="Web" />
	                                                    <label for="media32">Web</label>
	                                                </div>   	                                                	 	      
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media33" value="Lainnya" />
	                                                    <label for="media33">Lainnya</label>
	                                                </div>	                                                
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-md-2 col-form-label">Status Pasien</label>
	                                            <div class="col-md-10">
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="pasien_type" id="pasien_type_old4" value="old" />
	                                                    <label for="pasien_type_old4">Pasien Lama</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="pasien_type" id="pasien_type_new4" value="new" checked>
	                                                    <label for="pasien_type_new4">Pasien Baru</label>
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
	                                           		{!! form_input('nama','','class="form-control form-control-sm new_group" id="kontak" required placeholder="Nama Pasien"') !!}
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
	                                               {!! form_input('ibuanak_umur','','class="form-control form-control-sm new_group" id="kontak" required placeholder="Umur"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Nama Suami/ Pananggung Jwb</label>
	                                            <div class="col-md-10">
	                                               {!! form_input('ibuanak_namasuami','','class="form-control form-control-sm new_group" id="kontak" required placeholder="Nama Suami"') !!}
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
	                                                <select class="form-control form-control-sm default-select2" name="ibuanak_kodebidan" required style="width: 100%">
	                                                    <option>Pilih Status Faskes</option>
	                                                    <option value="1">Negeri/Pemerintah</option>
	                                                    <option value="2">Swasta/Pribadi</option>
	                                                </select>
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
	                                        <h1 class="page-header f-s-16 f-w-500">Diagnosa</h1> 
	                                        <hr class="m-t-0">
	                                        <div class="form-group row m-b-15">
	                                            <label class="col-form-label col-md-2">Diagnosa</label>
	                                            <div class="col-md-10">
	                                                 {!! form_textarea('diagnosis','','class="form-control" required style="height: 80px" placeholder="Jika COVID, tambah info status COVID & COMORBID, misal: PDP COVID, Confirmed + COVID & DM. PILIH KELAS BED: ISOLASI COVID, LAYANAN RS: ISOLASI COVID "') !!}
	                                                <small>Neonatal Diagnosa: GPA, Usia Gestasi, Komplikasi , Cara lahir, Apgar score, warna ketuban, BB,PB, LL,LK, Usia Bayi, Vital Sign: TD, Suhu,Nadi, Respirasi.</small>
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">ICD X</label>
	                                            <div class="col-md-10">
	                                                <select name="ibuanak_icdx" class="cb-icdx form-control form-control-sm" required style="width: 100%"></select>
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Pemeriksaan Penunjang</label>
	                                            <div class="col-md-10">
	                                                {!! form_input('alasan_rujukan','','class="form-control" placeholder="Jika COVID, tulis alasan perawatan yg diperlukan, misal: Ventilator, SpPD, Sp Paru, Perlu Ruang ISOLASI COVID"') !!}
	                                                <small>pemeriksaan hiv, hbsag, cek protein urin, tespek, usg</small>
	                                            </div>
	                                        </div>
	                                        <div class="form-group row m-b-15">
	                                            <label class="col-form-label col-md-2">Tindakan Pra Rujukan</label>
	                                            <div class="col-md-10">
	                                                {!! form_input('tindakan','','class="form-control form-control-sm" id="tindakan" required placeholder="Tata Laksana Pra Rujukan/Stabilisasi"') !!}
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
	                
	                <div class="tab-pane fade" id="default-tab-5">
	                	{!! form_open_multipart() !!}
	                	<input type="hidden" name="type" value="5">
	                	<input type="hidden" name="jenis_kelamin" value="" value="0">
	                    <div class="panelruj1 panel-inverse" data-sortable-id="table-basic-5">
	                        <div class="panel-body">
	                            <form>
	                                <div class="row">
	                                    <div class="col-lg-6">
	                                        <h1 class="page-header f-s-16 f-w-500">Data Pasien Bayi Balita</h1>
	                                        <hr class="m-t-0">
	                                        <div class="form-group row">
	                                            <label class="col-md-2 col-form-label">Media Rujukan</label>
	                                            <div class="col-md-10">
	                                                <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media42" value="Tanpa CC" />
	                                                    <label for="media42"><b>TIDAK melalui CC</b></label>
	                                                </div>                                           	
	                                                <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media35" value="Telpon CC" />
	                                                    <label for="media35">CC PSC</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media36" value="Dispatch NCC" />
	                                                    <label for="media36">dari NCC</label>
	                                                </div>		                                                
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media37" value="SMS" />
	                                                    <label for="media37">SMS</label>
	                                                </div>                                                
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media40" value="Whatsapp" />
	                                                    <label for="media40">Whatsapp</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media38" value="Whatsapp Gateway" checked>
	                                                    <label for="media38">Whatsapp Gateway</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media39" value="Web" />
	                                                    <label for="media39">Web</label>
	                                                </div>   		                                                	 	      
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media41" value="Lainnya" />
	                                                    <label for="media41">Lainnya</label>
	                                                </div>	                                                
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-md-2 col-form-label">Status Pasien</label>
	                                            <div class="col-md-10">
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="pasien_type" id="pasien_type_old5" value="old" />
	                                                    <label for="pasien_type_old5">Pasien Lama</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="pasien_type" id="pasien_type_new5" value="new" checked>
	                                                    <label for="pasien_type_new5">Pasien Baru</label>
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
	                                           		{!! form_input('nama','','class="form-control form-control-sm new_group" id="kontak" required placeholder="Nama Pasien"') !!}
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
	                                               {!! form_input('ibuanak_umur','','class="form-control form-control-sm new_group" id="kontak" required placeholder="Umur"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Nama Suami/ Pananggung Jwb</label>
	                                            <div class="col-md-10">
	                                               {!! form_input('ibuanak_namasuami','','class="form-control form-control-sm new_group" id="kontak" required placeholder="Nama Suami"') !!}
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
	                                                <select class="form-control form-control-sm default-select2" name="ibuanak_kodebidan" required style="width: 100%">
	                                                    <option>Pilih Status Faskes</option>
	                                                    <option value="1">Negeri/Pemerintah</option>
	                                                    <option value="2">Swasta/Pribadi</option>
	                                                </select>
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
	                                        <h1 class="page-header f-s-16 f-w-500">Diagnosa</h1> 
	                                        <hr class="m-t-0">
	                                        <div class="form-group row m-b-15">
	                                            <label class="col-form-label col-md-2">Diagnosa</label>
	                                            <div class="col-md-10">
	                                                 {!! form_textarea('diagnosis','','class="form-control" required style="height: 80px" placeholder="Jika COVID, tambah info status COVID & COMORBID, misal: PDP COVID, Confirmed + COVID & DM. PILIH KELAS BED: ISOLASI COVID, LAYANAN RS: ISOLASI COVID "') !!}
	                                                <small>Bayi Diagnosa: GPA, Usia Gestasi, Komplikasi , Cara lahir, Apgar score, warna ketuban, BB,PB, LL,LK, Usia Bayi, Vital Sign: TD, Suhu,Nadi, Respirasi.</small>
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">ICD X</label>
	                                            <div class="col-md-10">
	                                                <select name="ibuanak_icdx" class="cb-icdx form-control form-control-sm" required style="width: 100%"></select>
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Pemeriksaan Penunjang</label>
	                                            <div class="col-md-10">
	                                                {!! form_input('alasan_rujukan','','class="form-control" placeholder="Jika COVID, tulis alasan perawatan yg diperlukan, misal: Ventilator, SpPD, Sp Paru, Perlu Ruang ISOLASI COVID"') !!}
	                                                <small>pemeriksaan hiv, hbsag, cek protein urin, tespek, usg</small>
	                                            </div>
	                                        </div>
	                                        <div class="form-group row m-b-15">
	                                            <label class="col-form-label col-md-2">Tindakan Pra Rujukan</label>
	                                            <div class="col-md-10">
	                                                {!! form_input('tindakan','','class="form-control form-control-sm" id="tindakan" required placeholder="Tata Laksana Pra Rujukan/Stabilisasi"') !!}
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
	                
					<div class="tab-pane fade" id="default-tab-6">
	                	{!! form_open_multipart() !!}
	                	<input type="hidden" name="type" value="6">
	                	<input type="hidden" name="jenis_kelamin" value="" value="0">
	                    <div class="panelruj1 panel-inverse" data-sortable-id="table-basic-5">
	                        <div class="panel-body">
	                            <form>
	                                <div class="row">
	                                    <div class="col-lg-6">
	                                        <h1 class="page-header f-s-16 f-w-500">DATA KONSULTASI</h1>
	                                        <hr class="m-t-0">
	                                        <div class="form-group row">
	                                            <label class="col-md-2 col-form-label">Media Konsultasi</label>
	                                            <div class="col-md-10">
	                                                <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media43" value="Tanpa CC" />
	                                                    <label for="media43"><b>TIDAK melalui CC</b></label>
	                                                </div>                                           	
	                                                <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="media" id="media44" value="Telpon CC" />
	                                                    <label for="media44">CC PSC</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media45" value="Dispatch NCC" />
	                                                    <label for="media45">dari NCC</label>
	                                                </div>		                                                
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media47" value="SMS" />
	                                                    <label for="media47">SMS</label>
	                                                </div>                                                
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media48" value="Whatsapp" />
	                                                    <label for="media48">Whatsapp</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media50" value="Whatsapp Gateway" checked>
	                                                    <label for="media50">Whatsapp Gateway</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media51" value="Web" />
	                                                    <label for="media51">Web</label>
	                                                </div>   		                                                	 	      
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="media" id="media52" value="Lainnya" />
	                                                    <label for="media52">Lainnya</label>
	                                                </div>	                                                
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-md-2 col-form-label">Status Pasien</label>
	                                            <div class="col-md-10">
	                                                <div class="radio radio-css radio-inline">
	                                                	<input type="radio" name="pasien_type" id="pasien_type_old5" value="old" />
	                                                    <label for="pasien_type_old5">Pasien Lama</label>
	                                                </div>
	                                                <div class="radio radio-css radio-inline">
	                                                    <input type="radio" name="pasien_type" id="pasien_type_new5" value="new" checked>
	                                                    <label for="pasien_type_new5">Pasien Baru</label>
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
	                                           		{!! form_input('nama','','class="form-control form-control-sm new_group" id="kontak" required placeholder="Nama Pasien"') !!}
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
	                                               {!! form_input('ibuanak_umur','','class="form-control form-control-sm new_group" id="kontak" required placeholder="Umur"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Nama Suami/ Pananggung Jwb</label>
	                                            <div class="col-md-10">
	                                               {!! form_input('ibuanak_namasuami','','class="form-control form-control-sm new_group" id="kontak" required placeholder="Nama Suami"') !!}
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
	                                        <h1 class="page-header f-s-16 f-w-500">Data yang Konsultasi</h1>
	                                        <hr class="m-t-0">
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-3">Nomor yang Konsultasi</label>
	                                            <div class="col-md-9">
													<select class="form-control cb-telp-bidan" name="ibuanak_nobidan" style="width: 100%"></select>
	                                                {{-- form_input('ibuanak_nobidan','','class="form-control form-control-sm" id="kontak" required placeholder="Mulailah dengan 62, contoh 628112111828"') --}}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-3">Nama yg Konsultasi</label>
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
	                                                <select class="form-control form-control-sm default-select2" name="ibuanak_kodebidan" required style="width: 100%">
	                                                    <option>Pilih Status Faskes</option>
	                                                    <option value="1">Negeri/Pemerintah</option>
	                                                    <option value="2">Swasta/Pribadi</option>
	                                                </select>
	                                            </div>
	                                        </div>
	                                        <h1 class="page-header f-s-16 f-w-500">Fasilitas Kesehatan yang dicari</h1>
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
	                                        <h1 class="page-header f-s-16 f-w-500">Pertanyaan / Keluhan / Anamnesa</h1> 
	                                        <hr class="m-t-0">
	                                        <div class="form-group row m-b-15">
	                                            <label class="col-form-label col-md-2">Pertanyaan / Keluhan / Anamnesa</label>
	                                            <div class="col-md-10">
	                                                 {!! form_textarea('diagnosis','','class="form-control" required style="height: 80px" placeholder="Jika COVID, tambah info status COVID & COMORBID, misal: PDP COVID, Confirmed + COVID & DM. PILIH KELAS BED: ISOLASI COVID, LAYANAN RS: ISOLASI COVID "') !!}
	                                                <small>Bayi Diagnosa: GPA, Usia Gestasi, Komplikasi , Cara lahir, Apgar score, warna ketuban, BB,PB, LL,LK, Usia Bayi, Vital Sign: TD, Suhu,Nadi, Respirasi.</small>
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">ICD X</label>
	                                            <div class="col-md-10">
	                                                <select name="ibuanak_icdx" class="cb-icdx form-control form-control-sm" required style="width: 100%"></select>
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Pemeriksaan Penunjang</label>
	                                            <div class="col-md-10">
	                                                {!! form_input('alasan_rujukan','','class="form-control" placeholder="Jika COVID, tulis alasan perawatan yg diperlukan, misal: Ventilator, SpPD, Sp Paru, Perlu Ruang ISOLASI COVID"') !!}
	                                                <small>pemeriksaan hiv, hbsag, cek protein urin, tespek, usg</small>
	                                            </div>
	                                        </div>
	                                        <div class="form-group row m-b-15">
	                                            <label class="col-form-label col-md-2">Terapi / Obat yang sudah diberikan</label>
	                                            <div class="col-md-10">
	                                                {!! form_input('tindakan','','class="form-control form-control-sm" id="tindakan" required placeholder="Tata Laksana Pra Rujukan/Stabilisasi"') !!}
	                                            </div>
	                                        </div>
	                                        <div class="form-group row">
	                                            <label class="col-form-label col-md-2">Asuransi / Biaya</label>
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
				placeholder: 'Kode ICD X, KODE DIAGNOSA, WAJIB DIISI, konsultasi isi konsul',
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
