@extends('layouts.panel_layout')

@section('content')
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Rujukan</li>
    </ol>
	<h1 class="page-header f-s-14 f-w-600">Data Rujukan</h1>
	<div class="panel panel-inverse">
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="main-table">
						<thead>
						<tr>
							<th>Pasien</th>
							<th>Status</th>
							<th>Asal Rujuk Balik</th>
							<th>Tanggal</th>
							<th>Tindakan</th>
							<th>Diagnosa</th>
							<th>Tanggal Follow UP</th>
							<th>Tempat Follow UP</th>
						</tr>
						</thead>
						<tbody>
						</tbody>
						<tfoot>
						<tr>
							<th>Pasien</th>
							<th>Status</th>
							<th>Asal Rujuk Balik</th>
							<th>Tanggal</th>
							<th>Tindakan</th>
							<th>Diagnosa</th>
							<th>Tanggal Follow UP</th>
							<th>Tempat Follow UP</th>
						</tr>
						</tfoot>
					</table>
				</div>
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
					url:'{{base_url('panel/rujukan/konfirmasi/data')}}'
				},
				columns:[
					{data:'pasien'},
					{
						data:'status',
						render:function(data, type, row, meta){
							var r='';
							switch (data){
								case 'Pulang':
									r='<span class="label label-info">Pulang</span>';
									break;
								case 'Meninggal Dunia':
									r='<span class="label label-danger">Meninggal Dunia</span>';
									break;
								default:
									r=data;
							}
							return r;
						}
					},
					{data:'rs'},
					{data:'tanggal'},
					{data:'tindakan'},
					{data:'diagnosa'},
					{
						data:'tgl_fu',
						render:function(data, type, row, meta){
							r = '';
							if (data != '0000-00-00') r = data;
							return r;
						}
					},

					{data:'tempat'},
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
