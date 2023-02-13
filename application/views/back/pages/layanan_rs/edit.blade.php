@extends('layouts.panel_layout')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Form {{$page_desc}}</h3>
				</div>
				{!! form_open('','role="form"') !!}
				<div class="box-body">
					<div class="form-group">
						{!! form_label('Nama Rumah Sakit','id_rs') !!}
						{!! form_dropdown('id_rs',$selection_rs,$edit_data['id_rs'],'class="form-control" id="id_rs" required') !!}
					</div>
					<div class="form-group">
						{!! form_label('Nama','nama') !!}
						{!! form_input('nama',$edit_data['nama'],'class="form-control" id="nama" placeholder="Nama Dokter" required') !!}
					</div>
					<div class="form-group">
						{!! form_label('Nomor IDI','no_idi') !!}
						{!! form_input('no_idi',$edit_data['no_idi'],'class="form-control" id="no_idi" placeholder="Nomor IDI Dokter" required') !!}
					</div>
					<div class="form-group">
						{!! form_label('Bidang','bidang') !!}
						{!! form_input('bidang',$edit_data['bidang'],'class="form-control" id="bidang" placeholder="bidang" required') !!}
					</div>
				</div>
				<div class="box-footer">
					{!! form_submit('save','Simpan','class="btn btn-primary"') !!}
					{!! form_reset('reset','Reset','class="btn btn-warning"') !!}
					{!! anchor(base_url('panel/rumah_sakit/dokter'),'Back','class="btn btn-danger"') !!}
				</div>
				{!! form_close() !!}
			</div>
		</div>
	</div>
@endsection
@section('script')
	@include('partials.toastr_msg')
@endsection
