@extends('layouts.panel_layout')

@section('content')
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Data Bed</li>
    </ol>
	<h1 class="page-header f-s-14 f-w-500">Data Bed</h1>
	<div class="panel panel-inverse">
		<div class="wrapper bg-silver-lighter">
			<div class="btn-toolbar">
				<div class="dropdown m-r-2">
					<a href="{{base_url('panel/rumah_sakit/bed/add')}}" type="" class="btn btn-sm btn-primary">Tambah Bed</a>
				</div>
				<div class="dropdown m-r-2">
					<a href="{{base_url('panel/rumah_sakit/bed/template')}}" type="" class="btn btn-sm btn-success">Template Excel</a>
				</div>
				<div class="dropdown m-r-2">
					<a href="{{base_url('panel/rumah_sakit/bed/import')}}" type="" class="btn btn-sm btn-info">Import Excel</a>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="main-table">
					<thead>
					<tr>
						<th rowspan="2">Action</th>
						<th rowspan="2">Fasilitas Kesehatan</th>
						<th rowspan="2">Bed</th>
						<th rowspan="2">Kelas</th>
						<th colspan="2" class="text-center">Kapasitas</th>
						<th colspan="2" class="text-center">Terpakai/Tersedia</th>
						<th rowspan="2">Diubah</th>
					</tr>
					<tr>
						<th>Laki-laki</th>
						<th>Perempuan</th>
						<th>Laki-laki</th>
						<th>Perempuan</th>
					</tr>
					</thead>
					<tbody>
					</tbody>
					<!-- <tfoot>
						<tr>
							<th>Action</th>
							<th>Fasilitas Kesehatan</th>
							<th>Bed</th>
							<th>Kelas</th>
							<th>Laki-laki</th>
							<th>Perempuan</th>
							<th>Laki-laki</th>
							<th>Perempuan</th>
							<th>Diubah</th>
						</tr>
					</tfoot> -->
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
					url:'{{base_url('panel/rumah_sakit/bed/data')}}'
				},
				columns:[
					{
						data:'id_bed',
						render:function(data, type, row, meta){
							return "<div class=\"btn-group\">\n" +
									"<button type=\"button\" class=\"btn btn-default btn-sm\">Action</button>\n" +
									"<button type=\"button\" class=\"btn btn-default btn-sm dropdown-toggle\" data-toggle=\"dropdown\">\n" +
									"<span class=\"caret\"></span>\n" +
									"<span class=\"sr-only\">Toggle Dropdown</span>\n" +
									"</button>\n" +
									"<ul class=\"dropdown-menu\" role=\"menu\">\n" +
									"<li><a href=\"{{base_url('panel/rumah_sakit/bed/edit/')}}"+data+"\">Edit</a></li>\n" +
									"<li><a class='konfirmasi-hapus' href=\"{{base_url('panel/rumah_sakit/bed/delete/')}}"+data+"\">Delete</a></li>\n" +
									"</ul>\n" +
									"</div>";
						}
					},
					{data:'nama_rs'},
					{data:'nama'},
					{data:'kelas'},
					{data:'kapasitas_l'},
					{data:'kapasitas_p'},
					{
						data:'terpakai_l',
						render: function(data, type, row, meta){
							return data+'/'+(Number(row.kapasitas_l)-Number(data));
						}
					},
					{
						data:'terpakai_p',
						render: function (data,type,row,meta) {
							return data+'/'+(Number(row.kapasitas_p)-Number(data));
						}
					},
					{data:'tgl_update'}
				]
			});
		});
	</script>
@endSection
