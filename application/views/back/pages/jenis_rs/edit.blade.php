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
						{!! form_label('Nama','value') !!}
						{!! form_input('value',$edit_data['value'],'class="form-control" id="nama" required') !!}
					</div>
					<div class="form-group">
						{!! form_submit('save','Simpan','class="btn btn-primary"') !!}
						{!! form_reset('reset','Reset','class="btn btn-warning"') !!}
						{!! anchor(base_url('panel/admin/jenis'),'Back','class="btn btn-danger"') !!}
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
