@extends('layouts.panel_layout')

@section('content')
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Laporan Rujukan Keluar</li>
    </ol>
    <h1 class="page-header f-s-14 f-w-500">Form {{$page_desc}}</h1>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-inverse">
				{!! form_open('','role="form"') !!}
				<div class="panel-body">
					<div class="form-group">
						{!! form_label('Fasilitas Kesehatan','id_rs') !!}
						{!! form_dropdown('id_rs',$selection_rs,'','class="form-control" id="id_rs" required') !!}
					</div>
					<div class="form-group">
						{!! form_label('Rentang Waktu','rentang') !!}
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" class="form-control pull-right" id="rentang">
						</div>
						{!! form_hidden('start',date('Y-m-d')) !!}
						{!! form_hidden('end',date('Y-m-d')) !!}
					</div>
					<div class="form-group row text-left">
	                	<div class="col-md-12">
							{!! form_submit('save','Simpan','class="btn btn-primary"') !!}
							{!! form_reset('reset','Reset','class="btn btn-warning"') !!}
							{!! anchor(base_url('panel/rujukan/balik'),'Back','class="btn btn-danger"') !!}
						</div>
					</div>
				</div>
				
				{!! form_close() !!}
			</div>
		</div>
	</div>
@endsection
@section('head')
	<link rel="stylesheet" href="{{load_asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
@endsection
@section('script')
	@include('partials.toastr_msg')
	<script src="{{load_asset('bower_components/moment/min/moment.min.js')}}"></script>
	<script src="{{load_asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
	<script type="text/javascript">
		$(function(){
			$('#rentang').daterangepicker({
				autoApply:true,
				opens:'right'
			},function(start, end, label){
				$('input[name="start"]').val(start.format('YYYY-MM-DD'));
				$('input[name="end"]').val(end.format('YYYY-MM-DD'));
			});
		})
	</script>
@endsection
