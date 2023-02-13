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
                            <span class="d-sm-block d-none">Rujukan Ibu dan Anak <span class="label label-info">Maternal Neonatal</span></span>
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
                                            <h1 class="page-header f-s-16 f-w-500">Data Pasien</h1>
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
                                                        <input type="radio" name="media" id="media3" value="SMS" checked>
                                                        <label for="media3">SMS</label>
                                                    </div>                                                
                                                    <div class="radio radio-css radio-inline">
                                                        <input type="radio" name="media" id="media4" value="Whatsapp" />
                                                        <label for="media4">Whatsapp</label>
                                                    </div>
                                                    <div class="radio radio-css radio-inline">
                                                        <input type="radio" name="media" id="media5" value="Web" />
                                                        <label for="media5">Web</label>
                                                    </div>
                                                    <div class="radio radio-css radio-inline">
                                                        <input type="radio" name="media" id="media6" value="Android" />
                                                        <label for="media6">Android</label>
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
                                                <label class="col-form-label col-md-2">Asal Faskes</label>
                                                <div class="col-md-10">
                                                    {!! form_dropdown('id_rs_perujuk',$perujuk,'','class="form-control default-select2" id="id_rs_perujuk" required style="width: 100%"') !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-2">Nomor Perujuk</label>
                                                <div class="col-md-10">
                                                    {!! form_input('ibuanak_nobidan','','class="form-control form-control-sm" id="kontak" placeholder="Mulailah dengan 62, contoh 628112111828"') !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-2">Nama Perujuk</label>
                                                <div class="col-md-10">
                                                      {!! form_dropdown('ibuanak_namabidan',$namabidandokter,'','class="form-control default-select2" id="kontak" required style="width: 100%"') !!}
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
                        <div class="panelruj1 panel-inverse" data-sortable-id="table-basic-5">
                            <div class="panel-body">
                                <form>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h1 class="page-header f-s-16 f-w-500">Data Pasien</h1>
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
                                                        <input type="radio" name="media" id="media13" value="SMS" checked>
                                                        <label for="media13">SMS</label>
                                                    </div>                                                
                                                    <div class="radio radio-css radio-inline">
                                                        <input type="radio" name="media" id="media14" value="Whatsapp" />
                                                        <label for="media14">Whatsapp</label>
                                                    </div>
                                                    <div class="radio radio-css radio-inline">
                                                        <input type="radio" name="media" id="media15" value="Web" />
                                                        <label for="media15">Web</label>
                                                    </div>
                                                    <div class="radio radio-css radio-inline">
                                                        <input type="radio" name="media" id="media16" value="Android" />
                                                        <label for="media16">Android</label>
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
                                                <label class="col-form-label col-md-2">Nomor Perujuk</label>
                                                <div class="col-md-10">
                                                    {!! form_input('ibuanak_nobidan','','class="form-control form-control-sm" id="kontak" placeholder="Mulailah dengan 62, contoh 628112111828"') !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-2">Nama Perujuk</label>
                                                <div class="col-md-10">
                                                      {!! form_dropdown('ibuanak_namabidan',$namabidandokter,'','class="form-control default-select2" id="kontak" required style="width: 100%"') !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-2">Status Faskes</label>
                                                <div class="col-md-10">
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
                                            <h1 class="page-header f-s-16 f-w-500">Diagnosa</h1>
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
                placeholder: 'Kode ICD X',
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
    </script>
@endsection

@section('head')
    <link rel="stylesheet" href="{{load_asset('bower_components/select2/dist/css/select2.min.css')}}">
@endsection
