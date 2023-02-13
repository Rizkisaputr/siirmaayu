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
						{!! form_dropdown('id_rs',$selection_rs,'','class="form-control form-control-sm" id="id_rs" required') !!}
					</div>
					<div class="form-group">
						{!! form_label('Nama Alat Kesehatan','nama_faskes') !!}
						{!! form_input('nama_faskes','','class="form-control form-control-sm" id="nama_faskes" placeholder="Nama Alat Kesehatan" required') !!}
					</div>
					<div class="form-group">
						{!! form_label('Jumlah Alat Kesehatan','jumlah') !!}
						{!! form_input('jumlah','','class="form-control form-control-sm" id="jumlah" placeholder="Jumlah Alat Kesehatan" required') !!}
					</div>
					<div class="form-group">
						{!! form_submit('save','Simpan','class="btn btn-primary btn-sm"') !!}
						{!! form_reset('reset','Reset','class="btn btn-warning btn-sm"') !!}
						{!! anchor(base_url('panel/rumah_sakit/faskes'),'Back','class="btn btn-danger btn-sm"') !!}
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
