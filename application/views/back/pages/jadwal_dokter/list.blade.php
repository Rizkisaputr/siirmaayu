@extends('layouts.panel_layout')

@section('content')
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Jadwal Dokter</li>
    </ol>
	<h1 class="page-header f-s-14 f-w-500">Jadwal Dokter</h1>
	<div class="panel panel-inverse">
		<div class="wrapper bg-silver-lighter">
			<div class="btn-toolbar">
				<div class="dropdown m-r-2">
					<a href="{{base_url('panel/rumah_sakit/jadwal_dokter/add')}}" type="" class="btn btn-sm btn-primary">Tambah Jadwal Dokter</a>
				</div>
				<div class="dropdown m-r-2">
					<a href="{{base_url('panel/rumah_sakit/jadwal_dokter/template')}}" type="" class="btn btn-sm btn-success">Template Excel</a>
				</div>
				<div class="dropdown m-r-2">
					<a href="{{base_url('panel/rumah_sakit/jadwal_dokter/import')}}" type="" class="btn btn-sm btn-info">Import Excel</a>
				</div>
				<!--<div class="dropdown m-r-2">
					<a href="{{base_url('panel/rumah_sakit/jadwal_dokter/data')}}" type="" class="btn btn-sm btn-success">Template Excel</a>
				</div>
				<div class="dropdown m-r-2">
					<a href="{{base_url('panel/rumah_sakit/jadwal_dokter/data')}}" type="" class="btn btn-sm btn-info">Import Excel</a>
				</div>-->
			</div>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="main-table">
				<thead>
					<tr>
						<th>Action</th>
						<th>Dokter</th>
						<th>Hari</th>
						<th>Jam Mulai</th>
						<th>Jam Selesai</th>
						<th>Diupdate</th>
					</tr>
					</thead>
					<tbody>
					<tr>
					</tr>
					</tbody>
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
					url:'{{base_url('panel/rumah_sakit/jadwal_dokter/data')}}'
				},
				columns:[
					{
						data:'id_jadwal_dokter',
						render:function(data, type, row, meta){
							return "<div class=\"btn-group\">\n" +
									"<button type=\"button\" class=\"btn btn-default btn-sm\">Action</button>\n" +
									"<button type=\"button\" class=\"btn btn-default btn-sm dropdown-toggle\" data-toggle=\"dropdown\">\n" +
									"<span class=\"caret\"></span>\n" +
									"<span class=\"sr-only\">Toggle Dropdown</span>\n" +
									"</button>\n" +
									"<ul class=\"dropdown-menu\" role=\"menu\">\n" +
									"<li><a href=\"{{base_url('panel/rumah_sakit/jadwal_dokter/edit/')}}"+data+"\">Edit</a></li>\n" +
									"<li><a class='konfirmasi-hapus' href=\"{{base_url('panel/rumah_sakit/jadwal_dokter/delete/')}}"+data+"\">Delete</a></li>\n" +
									"</ul>\n" +
									"</div>";
						}
					},
					{data:'nama'},
					{
						data:'hari',
						render: function(data,type,row,meta){
							switch (Number(data)){
								case 0:
									return 'Senin';
									break;
								case 1:
									return 'Selasa';
									break;
								case 2:
									return 'Rabu';
									break;
								case 3:
									return 'Kamis';
									break;
								case 4:
									return 'Jumat';
									break;
								case 5:
									return 'Sabtu';
									break;
								case 6:
									return 'Minggu';
									break;
								default:
									return 'Kesalahan Input';
							}
						}
					},
					{data:'jam_mulai'},
					{data:'jam_selesai'},
					{data:'tgl_update'}
				]
			});
		});
	</script>
@endSection
