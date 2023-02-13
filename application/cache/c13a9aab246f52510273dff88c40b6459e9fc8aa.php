<?php $__env->startSection('content'); ?>
<div id="content" class="content">
	<ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active"><?php echo e($title); ?></li>
    </ol>
	<h1 class="page-header f-s-14 f-w-600"><?php echo e($title); ?></h1>
	<div class="panel panel-inverse">
		<div class="wrapper bg-silver-lighter">
			<div class="btn-toolbar">
                <div class="dropdown m-r-2">
                    <a href="<?php echo e(base_url('panel/rujukan/psc/add')); ?>" class="btn btn-sm btn-success">
                      <b>Buat Rujukan PSC</b>
                    </a>
                </div>
            </div>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="main-table">
					<thead>
					<tr>
						<th>RS Dirujuk</th>
						<th>Pelapor</th>
						<th>Kontak</th>
						<th>Nama Penderita</th>
						<th>Kategori PSC</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					</tbody>
					<tfoot>
					<tr>
						<th>RS Dirujuk</th>
						<th>Pelapor</th>
						<th>Kontak</th>
						<th>Nama Penderita</th>
						<th>Kategori PSC</th>
						<th>Action</th>
					</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('head'); ?>
	<link rel="stylesheet" href="<?php echo e(load_asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
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
				autoWidth :false,
				order:[[3,'desc']],
				processing:true,
				serverSide:true,
				ajax:{
					url:'<?php echo e(base_url('panel/rujukan/psc/data')); ?>'
				},
				columns:[
					{data:'nama_rs',},
					{data:'nama_pelapor'},
					{data:'kontak_pelapor'},
					{data:'nama_penderita'},
					{data:'kategori_psc'},
					{
						data:'id_psc',
						render:function(data, type, row, meta){
							return "<div class=\"btn-group\">\n" +
									"<button type=\"button\" class=\"btn btn-default btn-flat\">Action</button>\n" +
									"<button type=\"button\" class=\"btn btn-default btn-flat dropdown-toggle\" data-toggle=\"dropdown\">\n" +
									"<span class=\"caret\"></span>\n" +
									"<span class=\"sr-only\">Toggle Dropdown</span>\n" +
									"</button>\n" +
									"<ul class=\"dropdown-menu\" role=\"menu\">\n" +
									"<li><a href=\"<?php echo e(base_url('panel/rujukan/psc/edit/')); ?>"+data+"\">Edit</a></li>\n" +
									"<li><a class='konfirmasi-hapus' href=\"<?php echo e(base_url('panel/rujukan/psc/delete/')); ?>"+data+"\">Delete</a></li>\n" +
									"</ul>\n" +
									"</div>";
						}
					},
				]
			});
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.panel_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>