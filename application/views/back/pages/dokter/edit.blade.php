@extends('layouts.panel_layout')

@section('content')
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Form {{$page_desc}}</li>
    </ol>
	<h1 class="page-header f-s-14 f-w-500">Form {{$page_desc}}</h1>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-inverse">
				{!! form_open('','role="form"') !!}
				<div class="panel-body">
					<div class="form-group">
						{!! form_label('Nama Fasilitas Kesehatan','id_rs') !!}
						{!! form_dropdown('id_rs',$selection_rs,$edit_data['id_rs'],'class="form-control form-control-sm" id="id_rs" required') !!}
					</div>
					<div class="form-group">
						{!! form_label('Nama Dokter','nama') !!}
						{!! form_input('nama',$edit_data['nama'],'class="form-control form-control-sm" id="nama" placeholder="Nama Dokter" required') !!}
					</div>
					<div class="form-group">
						{!! form_label('Nomor NPA IDI','no_idi') !!}
						{!! form_input('no_idi',$edit_data['no_idi'],'class="form-control form-control-sm" id="no_idi" placeholder="Nomor IDI Dokter" required') !!}
					</div>
					<div class="form-group">
						{!! form_label('Spesialis','spesialis') !!}
						{!! form_dropdown('spesialis',array('0'=>'Dr Umum','1'=>'Sp.OG','2'=>'Sp.A','3'=>'Sp.PD','4'=>'Sp.P','5'=>'Sp.An','6'=>'Sp.Rad','7'=>'Sp. Lainnya, Tuliskan di Kolom Bidang'),'','class="form-control form-control-sm" id="spesialis" placeholder="spesialis" required') !!}
					</div>
					<div class="form-group">
						{!! form_label('Nama Kepanjangan Gelar','bidang') !!}
						{!! form_input('bidang',$edit_data['bidang'],'class="form-control form-control-sm" id="bidang" placeholder="bidang" required') !!}
					</div>
					<div class="form-group">
						{!! form_submit('save','Simpan','class="btn btn-primary btn-sm"') !!}
						{!! form_reset('reset','Reset','class="btn btn-warning btn-sm"') !!}
						{!! anchor(base_url('panel/rumah_sakit/dokter'),'Back','class="btn btn-danger btn-sm"') !!}
					</div>
				</div>
				
				{!! form_close() !!}
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
	@include('partials.toastr_msg')
@endsection
