<?php $__env->startSection('content'); ?>
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Alat Kesehatan</li>
    </ol>
	<h1 class="page-header f-s-14 f-w-500">Alat Kesehatan</h1>
	<div class="panel panel-inverse">
		<div class="wrapper bg-silver-lighter">
			<div class="btn-toolbar">
				<div class="dropdown m-r-2">
					<a href="<?php echo e(base_url('panel/rumah_sakit/faskes/add')); ?>" type="" class="btn btn-sm btn-primary">Tambah Alat Kesehatan</a>
				</div>
				<div class="dropdown m-r-2">
					<a href="<?php echo e(base_url('panel/rumah_sakit/faskes/template')); ?>" type="" class="btn btn-sm btn-success">Template Excel</a>
				</div>
				<div class="dropdown m-r-2">
					<a href="<?php echo e(base_url('panel/rumah_sakit/faskes/import')); ?>" type="" class="btn btn-sm btn-info">Import Excel</a>
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
						<th>Fasilitas</th>
						<th>Jumlah</th>
						<th>Diubah</th>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('head'); ?>
	<link rel="stylesheet" href="<?php echo e(load_asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
	<script src="<?php echo e(load_asset('bower_components/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
	<script src="<?php echo e(load_asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script>
	<?php echo $__env->make('partials.toastr_msg', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('partials.sirine', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
					url:'<?php echo e(base_url('panel/rumah_sakit/faskes/data')); ?>'
				},
				columns:[
					{
						data:'id_faskes',
						render:function(data, type, row, meta){
							return "<div class=\"btn-group\">\n" +
									"<button type=\"button\" class=\"btn btn-default btn-sm\">Action</button>\n" +
									"<button type=\"button\" class=\"btn btn-default btn-sm dropdown-toggle\" data-toggle=\"dropdown\">\n" +
									"<span class=\"caret\"></span>\n" +
									"<span class=\"sr-only\">Toggle Dropdown</span>\n" +
									"</button>\n" +
									"<ul class=\"dropdown-menu\" role=\"menu\">\n" +
									"<li><a href=\"<?php echo e(base_url('panel/rumah_sakit/faskes/edit/')); ?>"+data+"\">Edit</a></li>\n" +
									"<li><a class='konfirmasi-hapus' href=\"<?php echo e(base_url('panel/rumah_sakit/faskes/delete/')); ?>"+data+"\">Delete</a></li>\n" +
									"</ul>\n" +
									"</div>";
						}
					},
					{data:'nama_rs'},
					{data:'nama_faskes'},
					{data:'jumlah'},
					{data:'tgl_update'}
				]
			});
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.panel_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>