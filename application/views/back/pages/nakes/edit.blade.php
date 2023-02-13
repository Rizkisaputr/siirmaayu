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
						{!! form_dropdown('id_rs',$selection_rs,$edit_data['id_rs'],'class="form-control form-control-sm" id="id_rs" required') !!}
					</div>
					<div class="form-group">
						{!! form_label('Nama','nama') !!}
						{!! form_input('nama',$edit_data['nama'],'class="form-control form-control-sm" id="nama"') !!}
					</div>
					<div class="form-group">
						{!! form_label('Profesi','profesi') !!}
						{!! form_input('profesi_name',$edit_data['profesi_name'],'class="form-control form-control-sm" id="profesi"') !!}
					</div><div class="form-group">
						{!! form_label('Data SK','data_sk') !!}
						{!! form_input('data_sk',$edit_data['data_sk'],'class="form-control form-control-sm" id="data_sk"') !!}
					</div><div class="form-group">
						{!! form_label('Alamat','alamat') !!}
						{!! form_input('alamat',$edit_data['alamat'],'class="form-control form-control-sm" id="alamat"') !!}
					</div><div class="form-group">
						{!! form_label('Telepon','telp') !!}
						{!! form_input('telp',$edit_data['telp'],'class="form-control form-control-sm" id="telp"') !!}
					</div><div class="form-group">
						{!! form_label('Email','email') !!}
						{!! form_input('email',$edit_data['email'],'class="form-control form-control-sm" id="email"') !!}
					</div><div class="form-group">
						{!! form_label('Keterangan','keterangan') !!}
						{!! form_textarea('keterangan',$edit_data['keterangan'],'class="form-control form-control-sm" id="keterangan" style="height: 60px"') !!}
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