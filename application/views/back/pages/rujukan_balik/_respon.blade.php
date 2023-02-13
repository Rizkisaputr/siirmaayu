@extends('layouts.panel_layout')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Data Rujukan</h3>
				</div>
				<div class="box-body no-padding">
					<table class="table table-striped">
						@foreach($detil_rujukan as $key=>$val)
							<tr>
							@if(($key==='attachment_1'||$key==='attachment_2'||$key==='attachment_3'))
								<td>Lampiran</td>
								<td>{!! $val!=''?anchor(load_asset('public/'.$val),'Download','target="_blank"'):'Tidak Ada' !!}</td>
							@else
								<td>{{$key}}</td>
								<td>{{$val?$val:'-'}}</td>
							@endif
							</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Form {{$page_desc}}</h3>
				</div>
				<div class="box-body form-horizontal">
					{!! form_open() !!}
					<div class="form-group">
						{!! form_label('Status Rujukan','status_rujukan','class="col-sm-2 control-label"') !!}
						<div class="col-sm-10">
							{!! form_dropdown('status_rujukan',array('Diterima'=>'Diterima','Ditolak'=>'Ditolak'),'','class="form-control" id="status_rujukan" placeholder="Status Rujukan"') !!}
						</div>
					</div>
					<div class="form-group">
						{!! form_label('Informasi Rujuk Balik','info_rujuk_balik','class="col-sm-2 control-label"') !!}
						<div class="col-sm-10">
							{!! form_textarea('info_rujuk_balik','','class="form-control" id="info_rujuk_balik" placeholder="Informasi"') !!}
						</div>
					</div>
					<div class="box-footer">
						{!! form_submit('save','Simpan','class="btn btn-primary"') !!}
						{!! form_reset('reset','Reset','class="btn btn-warning"') !!}
						{!! anchor(base_url('panel/rujukan/balik'),'Back','class="btn btn-danger"') !!}
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

@section('head')

@endsection
