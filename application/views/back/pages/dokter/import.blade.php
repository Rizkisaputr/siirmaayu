@extends('layouts.panel_layout')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Form {{$page_desc}}</h3>
				</div>
				{!! form_open_multipart('','role="form"') !!}
				<div class="box-body">
					<div class="form-group">
						{!! form_label('Nama Fasilitas Kesehatan','id_rs') !!}
						{!! form_dropdown('id_rs',$selection_rs,'','class="form-control" id="id_rs" required') !!}
					</div>
					<div class="form-group">
						{!! form_label('Import File Excel','file') !!}
						{!! form_upload('file','','id="file" required') !!}
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
