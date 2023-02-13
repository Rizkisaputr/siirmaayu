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
			<div class="panel -panel-inverse">
				{!! form_open('','role="form"') !!}
				<div class="panel-body">
					<div class="form-group">
						{!! form_label('Nama Fasilitas Kesehatan','id_rs') !!}
						{!! form_dropdown('id_rs',$selection_rs,'','class="form-control form-control-sm" id="id_rs" required') !!}
					</div>
					<div class="form-group">
						{!! form_label('Nama','nama') !!}
						{!! form_input('nama','','class="form-control form-control-sm" id="nama" placeholder="isilah dengan nama lengkap beserta gelar, contoh dr. Alfian Rahmawan, M.Kes"') !!}
					</div>
					<div class="form-group">
						{!! form_label('Profesi','profesi') !!}
						{!! form_input('profesi_name','','class="form-control form-control-sm" id="profesi" placeholder="isilah dengan dokter, bidan, perawat, sopir ambulan, dst"') !!}
					</div><div class="form-group">
						{!! form_label('Nomor SK','data_sk') !!}
						{!! form_input('data_sk','','class="form-control form-control-sm" id="data_sk" placeholder="jika tidak ada isi -"') !!}
					</div><div class="form-group">
						{!! form_label('Alamat','alamat') !!}
						{!! form_input('alamat','','class="form-control form-control-sm" id="alamat" placeholder="contoh: Jl. Karangpawitan - A.Yani no 134, Desa Wararaja, Kec Tarogong"') !!}
					</div><div class="form-group">
						{!! form_label('Telepon','telp') !!}
						{!! form_input('telp','','class="form-control form-control-sm" id="telp" placeholder="Mulailah dengan 62, TANPA SPASI, TANPA STRIP, contoh 628112111828"') !!}
					</div><div class="form-group">
						{!! form_label('Email','email') !!}
						{!! form_input('email','','class="form-control form-control-sm" id="email" placeholder="contoh alfian@gmail.com"') !!}
					</div><div class="form-group">
						{!! form_label('Keterangan','keterangan') !!}
						{!! form_textarea('keterangan','','class="form-control form-control-sm" id="keterangan" style="height: 60px" placeholder="isilah dengan kursus / sertifikasi yg dimiliki : GELS, PPGDON, ATCLS, dst"') !!}
					</div>
					<div class="form-group">
						{!! form_submit('save','Simpan','class="btn btn-primary btn-sm"') !!}
						{!! form_reset('reset','Reset','class="btn btn-warning btn-sm"') !!}
						{!! anchor(base_url('panel/rumah_sakit/ambulance'),'Back','class="btn btn-danger btn-sm"') !!}
					</div>
				</div>				
				{!! form_close() !!}
			</div>
		</div>
	</div>
</div>
@endsection
@section('head')
	<link rel="stylesheet" href="{{load_asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
@endsection
@section('script')
	@include('partials.toastr_msg')
	
@endsection
