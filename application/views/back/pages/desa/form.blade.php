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
						{!! form_label('Nama Desa','desa') !!}
						{!! form_input('desa',(isset($edit_data)?$edit_data['desa']:null),'class="form-control" id="desa" required') !!}
					</div>
					<div class="form-group">
						{!! form_dropdown('id_rs',$selection_rs,(isset($edit_data)?$edit_data['id_rs']:null),'id="id_rs" class="form-control select2" data-placeholder="Pilih Rumah Sakit" style="width: 100%;"') !!}
					</div>
					<div class="form-group">
						{!! form_submit('save','Simpan','class="btn btn-primary"') !!}
						{!! form_reset('reset','Reset','class="btn btn-warning"') !!}
						{!! anchor(base_url('panel/admin/desa'),'Back','class="btn btn-danger"') !!}
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
	<link rel="stylesheet" href="{{load_asset('bower_components/select2/dist/css/select2.min.css')}}">

	<script src="{{load_asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
	<script type="text/javascript">
		$(function(){
			$('.select2').select2();
		});
	</script>
@endsection
