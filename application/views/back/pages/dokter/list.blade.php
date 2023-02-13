@extends('layouts.panel_layout')

@section('content')
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Data Dokter</li>
    </ol>
	<h1 class="page-header f-s-14 f-w-500">Data Dokter</h1>
	<div class="panel panel-inverse">
		<div class="wrapper bg-silver-lighter">
			<div class="btn-toolbar">
				<div class="dropdown m-r-2">
					<a href="{{base_url('panel/rumah_sakit/dokter/add')}}" type="" class="btn btn-sm btn-primary">Tambah Dokter</a>
				</div>
				<div class="dropdown m-r-2">
					<a href="{{base_url('panel/rumah_sakit/dokter/template')}}" type="" class="btn btn-sm btn-success">Template Excel</a>
				</div>
				<div class="dropdown m-r-2">
					<a href="{{base_url('panel/rumah_sakit/dokter/import')}}" type="" class="btn btn-sm btn-info">Import Excel</a>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="main-table">
					<thead>
					<tr>
						<th>Action</th>
						<th>Fasilitas Kesehatan</th>
						<th>Nama</th>
						<th>Id Dokter</th>
						<th>NO NPA IDI</th>
						<th>Bidang</th>
						<th>Diubah</th>
					</tr>
					</thead>
					<tbody>
					<tr>
					</tr>
					</tbody>
					<tfoot>
					<tr>
						<th>Action</th>
						<th>Fasilitas Kesehatan</th>
						<th>Nama</th>
						<th>Id Dokter</th>
						<th>NO NPA IDI</th>
						<th>Bidang</th>
						<th>Diubah</th>
					</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection

@section('head')
	<link rel="stylesheet" href="{{load_asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endSection
@section('script')
	<script src="{{load_asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{load_asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
	@include('partials.toastr_msg')
	@include('partials.sirine')
	<script type="text/javascript">
		$(function(){
			$('#main-table').DataTable({
				columnDefs:[
					{'orderable':false,'targets':0}
				],
				processing:true,
				serverSide:true,
				autoWidth :false,
				ajax:{
					url:'{{base_url('panel/rumah_sakit/dokter/data')}}'
				},
				columns:[
					{
						data:'id_dokter',
						render:function(data, type, row, meta){
							return "<div class=\"btn-group\">\n" +
									"<button type=\"button\" class=\"btn btn-default btn-sm\">Action</button>\n" +
									"<button type=\"button\" class=\"btn btn-default btn-sm dropdown-toggle\" data-toggle=\"dropdown\">\n" +
									"<span class=\"caret\"></span>\n" +
									"<span class=\"sr-only\">Toggle Dropdown</span>\n" +
									"</button>\n" +
									"<ul class=\"dropdown-menu\" role=\"menu\">\n" +
									"<li><a href=\"{{base_url('panel/rumah_sakit/dokter/edit/')}}"+data+"\">Edit</a></li>\n" +
									"<li><a class='konfirmasi-hapus' href=\"{{base_url('panel/rumah_sakit/dokter/delete/')}}"+data+"\">Delete</a></li>\n" +
									"</ul>\n" +
									"</div>";
						}
					},
					{data:'nama_rs'},
					{data:'nama'},
					{data:'id_dokter'},
					{data:'no_idi'},
					{data:'bidang'},
					{data:'tgl_update'}
				]
			});
		});
	</script>
@endSection
