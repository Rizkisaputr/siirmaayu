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
						{!! form_label('Golongan Darah','gol_darah') !!}
						{!! form_dropdown('gol_darah',$selection_gol_darah,$edit_data['gol_darah'],'class="form-control form-control-sm" id="gol_darah"') !!}
					</div>
					<div class="form-group">
						{!! form_label('Stok','stok') !!}
						{!! form_input('stok',$edit_data['stok'],'class="form-control form-control-sm" id="stok"') !!}
					</div>
					<div class="form-group">
						{!! form_label('Keterangan','keterangan') !!}
						{!! form_textarea('keterangan',$edit_data['keterangan'],'class="form-control form-control-sm" id="keterangan" style="height: 60px"') !!}
					</div><div class="form-group">
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

@section('script')
	@include('partials.toastr_msg')
	
@endsection