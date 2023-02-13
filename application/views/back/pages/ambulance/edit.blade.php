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
						{!! form_label('Merk Mobil','merk') !!}
						{!! form_dropdown('merk',$selection_merk,$edit_data['merk'],'class="form-control form-control-sm" id="merk"') !!}
					</div>
					<div class="row">
						<div class="col-xs-4">
							<div class="bootstrap-timepicker">
								<div class="form-group">
									{!! form_label('Tahun Produksi','tahun') !!}
									{!! form_input('tahun_produksi',$edit_data['tahun_produksi'],'class="form-control form-control-sm" id="tahun"') !!}
								</div>
							</div>
						</div>
						<div class="col-xs-4">
							<div class="bootstrap-timepicker">
								<div class="form-group">
									{!! form_label('No Polisi','nopol') !!}
									{!! form_input('nopol',$edit_data['nopol'],'class="form-control form-control-sm" id="nopol"') !!}
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						{!! form_label('Fungsi Ambulance','fungsi') !!}
						{!! form_dropdown('fungsi',$selection_fungsi,$edit_data['fungsi'],'class="form-control form-control-sm" id="fungsi"') !!}
					</div>

					<div class="form-group">
						{!! form_label('API','api') !!}
						{!! form_textarea('api',$edit_data['api'],'class="form-control form-control-sm" id="api" style="height: 60px"') !!}
					</div>
					<div class="form-group">
						{!! form_submit('save','Simpan','class="btn btn-primary"') !!}
						{!! form_reset('reset','Reset','class="btn btn-warning"') !!}
						{!! anchor(base_url('panel/rumah_sakit/ambulance'),'Back','class="btn btn-danger"') !!}
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
