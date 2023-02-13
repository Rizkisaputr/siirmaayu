@extends('layouts.panel_layout')

@section('content')
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Rujukan Balik</li>
    </ol>
	<h1 class="page-header f-s-14 f-w-600">Data Rujukan Balik</h1>
	<div class="panel panel-inverse">
		<div class="wrapper bg-silver-lighter">
			<div class="btn-toolbar">
				<div class="dropdown m-r-2">
					<a href="{{base_url('panel/laporan/rujukan_balik')}}" type="" class="btn btn-sm btn-primary">Export Rujukan</a>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="main-table">
					<thead>
					<tr>
						<th>Pasien</th>
						<th>Tujuan</th>
						<th>Tanggal</th>
						<th>Alasan</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					</tbody>
					<tfoot>
					<tr>
						<th>Pasien</th>
						<th>Tujuan</th>
						<th>Tanggal</th>
						<th>Alasan</th>
						<th>Status</th>
						<th>Action</th>
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
	<style rel="stylesheet">
		@-webkit-keyframes blinker {
			from {opacity: 1.0;}
			to {opacity: 0.0;}
		}
		.blink-infinite{
			text-decoration: blink;
			-webkit-animation-name: blinker;
			-webkit-animation-duration: 0.6s;
			-webkit-animation-iteration-count:infinite;
			-webkit-animation-timing-function:ease-in-out;
			-webkit-animation-direction: alternate;
		}
	</style>
@endSection
@section('script')
	<script src="{{load_asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{load_asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
	@include('partials.toastr_msg')
	@include('partials.sirine')
	<script type="text/javascript">
		$(function(){
			var table=$('#main-table').DataTable({
				columnDefs:[
					{'orderable':false,'targets':0}
				],
				autoWidth :false,
				// processing:true,
				serverSide:true,
				order:[[11,'desc']],
				ajax:{
					url:'{{base_url('panel/rujukan/balik/data')}}'
				},
				columns:[
					{data:'pasien'},
					{data:'rs'},
					{data:'dibuat'},
					{data:'alasan_rujukan'},
					{
						data:'status_rujukan',
						render:function(data, type, row, meta){
							var r='';
							switch (data){
								case 'Diterima':
									r='<span class="label label-success">Diterima</span>';
									r+=' oleh '+row.full_name;
									break;
								case 'Ditolak':
									r='<span class="label label-warning">Ditolak</span>';
									r+=' oleh '+row.full_name;
									break;
								case 'Belum direspon':
									r='<span class="label label-danger blink-infinite">Belum Direspon</span>';
									break;
								case 'Dialihkan':
									r='<span class="label label-warning">Dialihkan</span> dari '+row.pengalih;
									break;
								default:
									r=data;
							}
							return r;
						}
					},
					{
						data:'id_rujukan',
						render:function(data, type, row, meta){		

							if (row.status_rujukan == 'Diterima') {
								if (row.rujukbalik_status == 'Pulang' || row.rujukbalik_status == 'Meninggal Dunia' ) {
									return 'Sudah Dirujuk Balik';
								} else {
									return "<a class='btn btn-info btn-sm' href=\"{{base_url('panel/rujukan/balik/jawab/')}}"+data+"\">Rujuk Balik</a>";
								} 
							} else {
							return "<a class='btn btn-danger btn-sm' href=\"{{base_url('panel/rujukan/balik/action/')}}"+data+"\">Jawab</a>";
							}

							/*return "<div class=\"btn-group\">\n" +
									"<button type=\"button\" class=\"btn btn-default btn-flat\">Action</button>\n" +
									"<button type=\"button\" class=\"btn btn-default btn-flat dropdown-toggle\" data-toggle=\"dropdown\">\n" +
									"<span class=\"caret\"></span>\n" +
									"<span class=\"sr-only\">Toggle Dropdown</span>\n" +
									"</button>\n" +
									"<ul class=\"dropdown-menu\" role=\"menu\">\n" +
									"<li><a href=\"{{base_url('panel/rujukan/balik/action/')}}"+data+"\">Respon</a></li>\n" +
									"</ul>\n" +
									"</div>";
									*/
						}
					},
				]

			});

			function refresh_table(){
				Pace.restart();
				table.ajax.reload(function(json){
					setTimeout(refresh_table,10000);
				});
			}
			refresh_table();
		});
	</script>
@endSection
