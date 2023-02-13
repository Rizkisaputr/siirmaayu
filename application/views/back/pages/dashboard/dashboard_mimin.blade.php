@extends('layouts.panel_layout')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">List Bed</h3>
				</div>
				<div class="box-body table-responsive">
					<table class="table table-bordered table-hover" id="main-table">
						<thead>
						<tr>
							<th rowspan="2">Rumah Sakit</th>
							<th rowspan="2">Bed</th>
							<th rowspan="2">Kelas</th>
							<th colspan="2">Kapasitas</th>
							<th colspan="2">Terpakai</th>
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
						<tfoot>
						<tr>
							<th>Rumah Sakit</th>
							<th>Bed</th>
							<th>Kelas</th>
							<th>Laki-laki</th>
							<th>Perempuan</th>
							<th>Laki-laki</th>
							<th>Perempuan</th>
							<th>Diubah</th>
						</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-aqua"><i class="fa fa-database"></i></span>
				<div class="info-box-content">
					<span class="info-box-number">Backup Database</span>
					<span class="info-box-text"><a href="{{base_url('panel/backup_db')}}" type="button" class="btn btn-block btn-info btn-flat"><i class="fa fa-download"></i> Download</a></span>
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
				processing:true,
				serverSide:true,
				autoWidth :false,
				ajax:{
					url:'{{base_url('panel/dashboard_data_bed')}}'
				},
				order:[[7,'desc']],
				columns:[
					{data:'nama_rs'},
					{data:'nama'},
					{data:'kelas'},
					{data:'kapasitas_l'},
					{data:'kapasitas_p'},
					{data:'terpakai_l'},
					{data:'terpakai_p'},
					{data:'tgl_update'}
				]
			});
		});
	</script>
@endsection
